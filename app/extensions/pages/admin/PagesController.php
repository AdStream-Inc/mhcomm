<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Config;
use Str;
use Response;
use Request;
use Adstream\Models\Pages;
use Adstream\Models\PageSections;
use Adstream\Controllers\BaseController;

class PagesController extends BaseController {

    private $model;

    private $tree;

    /**
     * Setup Pages repository and construct BaseController
     * for additional properties
     * @param Pages $pages Pages repository
     */
    public function __construct(Pages $pages, PageSections $sections)
    {
        parent::__construct();
        $this->model = $pages;
        $this->sections = $sections;
        $this->tree = $this->parsePageTree($this->model->all());
    }

    public function index()
    {
        $templates = Config::get('templates');
        $pagesDropdown = $this->getPagesDropdown();
        $pagesTree = $this->getPagesTree();
        $pagesDropdown = $this->getPagesDropdown();
        $templatesDropdown = $this->getTemplatesDropdown();

        return View::make('admin.pages.index', compact('templates', 'templatesDropdown', 'pagesDropdown', 'pagesTree'));
    }

    public function store()
    {
        $page = new $this->model(Input::all());
        $page->slug = Str::slug($page->name);

        if ($page->save()) {

            foreach (Input::get('templates') as $slug => $content) {
                $template = new $this->sections();
                $template->page_id = $page->id;
                $template->slug = $slug;
                $template->content = $content;
                $template->save();
            }

            Alert::success('Page successfully added!')->flash();
            return Redirect::route($this->adminUrl . '.pages.index');
        }

        return Redirect::back()->withInput()->withErrors($page->getErrors());
    }

    public function update($id)
    {
        $page = $this->model->find($id);
        $page->slug = Str::slug(Input::get('name'));

        if ($page->update(Input::all())) {

            $sections = Input::get('templates');
            foreach ($sections as $slug => $value) {
                $section = $this->sections->where('page_id', $page->id)->where('slug', $slug)->first();
                $section->content = $value;
                $section->save();
            }

            Alert::success('Job successfully updated!')->flash();
            return Redirect::route($this->adminUrl . '.pages.index');
        }

        return Redirect::back()->withInput()->withErrors($page->getErrors());
    }

    public function show($id)
    {
        if (Request::ajax()) {
            $data = array();
            $page = $this->model->find($id);
            $sections = $page->sections()->get();

            $data['page'] = $page->toArray();
            $data['sections'] = $sections->toArray();

            return Response::json($data);
        }
    }

    private function getTemplatesDropdown()
    {
        $templates = Config::get('templates');
        $templatesList = array();

        foreach( $templates as $key => $template) {
            $templatesList[$key] = $template['name'];
        }

        return $templatesList;
    }

    private function getPagesDropdown()
    {
        $select = array();

        $printDropdown = function($tree, $indent = 0) use(&$printDropdown, &$select) {
            foreach ($tree as $child) {
                $select[$child['id']] = str_repeat('-', $indent * 3) . ' ' . $child['name'];
                if (count($child['children'])) {
                    $printDropdown($child['children'], $indent + 1);
                }
            }
            return $select;
        };

        $select = $printDropdown($this->tree);

        array_unshift($select, '-- No Parent --');

        return $select;
    }

    private function getPagesTree()
    {
        $html = '';

        $printTree = function($tree) use(&$printTree, &$html) {
            $html .= '<ul class="tree-list">';

            foreach($tree as $node) {
                $html .= '<li><a href="#" data-id="' . $node['id'] . '">';
                $html .= $node['name'];
                $html .= '</a>';
                if (count($node['children'])) {
                    $printTree($node['children']);
                }
                $html .= '</li>';
            }

            $html .= '</ul>';

            return $html;
        };

        $html = $printTree($this->tree);

        return $html;
    }

    private function parsePageTree($pages, $parentId = 0) {
        $tree = array();

        foreach ($pages as $page) {
            if ($page->parent_id == $parentId) {
                $tree[] = array(
                    'id' => $page->id,
                    'name' => $page->name,
                    'slug' => $page->slug,
                    'parent_id' => $page->parent_id,
                    'children' => $this->parsePageTree($pages, $page->id)
                );
            }
        }

        return $tree;
    }
}