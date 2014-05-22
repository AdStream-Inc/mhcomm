<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Config;
use Str;
use Response;
use Request;
use Cache;
use Adstream\Models\Pages;
use Adstream\Models\PageSections;
use Adstream\Controllers\BaseController;

class PagesController extends BaseController {

    private $model;

    private $tree;

    private $lastUpdated;

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

        if (!$this->model->count()) {
            Cache::forget('lastUpdated');
        }

        if (Cache::has('lastUpdated')) {
            $lastUpdated = Cache::get('lastUpdated');
        } else {
            $lastUpdated = null;
        }
        return View::make('admin.pages.index', compact('templates', 'templatesDropdown', 'pagesDropdown', 'pagesTree', 'lastUpdated'));
    }

    public function store()
    {
        $page = new $this->model(Input::all());
        $page->slug = Str::slug($page->name);

        if ($this->validateName($page)) {
            if ($page->save()) {

                foreach (Input::get('templates') as $slug => $content) {
                    $template = new $this->sections();
                    $template->page_id = $page->id;
                    $template->slug = $slug;
                    $template->content = $content;
                    $template->save();
                }

                $this->setLastUpdated($page->id);

                Alert::success('Page [' . $page->name . '] successfully added!')->flash();
                return Redirect::route($this->adminUrl . '.pages.index');
            }
        }

        return Redirect::back()->withInput()->withErrors($page->getErrors());
    }

    public function update($id)
    {
        $page = $this->model->find($id);
        $page->slug = Str::slug(Input::get('name'));

        $parentId = Input::get('parent_id');

        $children = array();
        $findChildren = function($pageId) use (&$parentId, &$findChildren, &$children) {
            $childrenPages = $this->model->where('parent_id', $pageId)->get();
            if (count($childrenPages)) {
                foreach ($childrenPages as $child) {
                    if ($child->id == $parentId) {
                       $children[] = $child->id;
                    }

                    $findChildren($child->id);
                }
            }

            return $children;
        };

        if (count($findChildren($page->id))) {
            Alert::error('Cannot assign a parent page to a child page.')->flash();
            return Redirect::back()->withInput();
        }

        if ($this->validateName($page)) {
            if ($page->update(Input::all())) {

                $sections = Input::get('templates');
                foreach ($sections as $slug => $value) {
                    $section = $this->sections->where('page_id', $page->id)->where('slug', $slug)->first();
                    if (!$section) {
                        $section = new $this->sections();
                        $section->slug = $slug;
                        $section->page_id = $page->id;
                    }
                    $section->content = $value;
                    $section->save();
                }

                $this->setLastUpdated($page->id);

                Alert::success('Page [' . $page->name . '] successfully updated!')->flash();
                return Redirect::route($this->adminUrl . '.pages.index');
            }
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

    public function destroy($id) {
        $page = $this->model->find($id);

        if ($this->hasChildren($page)) {
            Alert::error('Cannot remove a page that has children pages assigned to it.')->flash();
            return Redirect::back()->withInput();
        }

        $page->delete();

        Alert::success('Page [' . $page->name . '] successfully deleted!')->flash();
        return Redirect::route($this->adminUrl . '.pages.index');
    }

    private function validateName($page) {
        $parentId = $page->parent_id;
        $name = $page->name;

        if ($page->id) {
            $collection = $this->model->where('parent_id', $parentId)->where('id', '!=', $page->id)->get();
        } else {
            $collection = $this->model->where('parent_id', $parentId)->get();
        }

        foreach ($collection as $page) {
            if ($page->name == $name) {
                Alert::error('Cannot have two pages with the same name under the same parent page.')->flash();
                return false;
            }
        }

        return true;
    }

    private function hasChildren($root) {
        $pages = $this->model->all();

        foreach ($pages as $page) {
            if ($page->parent_id == $root->id) {
                return true;
            }
        }

        return false;
    }

    private function setLastUpdated($id)
    {
        Cache::forget('lastUpdated');

        $lastUpdated = $this->model->find($id);
        $sections = array();
        foreach($lastUpdated->sections as $section) {
            $sections['sections'][$section->slug] = $section->content;
        }

        $lastUpdated = $lastUpdated->toArray();
        $lastUpdated = array_merge($lastUpdated, $sections);

        Cache::add('lastUpdated', $lastUpdated, 2);

        return $lastUpdated;
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
        $select = array(0 => '[ No Parent ]') + $select;

        return $select;
    }

    private function getPagesTree()
    {
        $html = '';

        $printTree = function($tree) use(&$printTree, &$html) {
            $html .= '<ul class="tree-list">';

            foreach($tree as $node) {
                if (Cache::has('lastUpdated')) {
                    $lastUpdated = Cache::get('lastUpdated');
                    if ($lastUpdated['id'] == $node['id']) {
                        $html .= '<li class="last-active">';
                    } else {
                        $html .= '<li>';
                    }
                } else {
                    $html .= '<li>';
                }
                $html .= '<a href="#" data-id="' . $node['id'] . '">';
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

        $html = count($this->tree) ? $printTree($this->tree) : '';

        return $html;
    }

    /**
     * Deprecated
     */
    private function parsePageUrl($root) {
        $url = array();

        $generateUrl = function($pages, $base) use (&$generateUrl, &$url) {

            array_unshift($url, $base->slug);

            foreach ($pages as $page) {
                if ($base->parent_id == $page->id) {
                    array_unshift($url, $page->slug);
                    $generateUrl($pages, $page);
                }
            }

            return $url;
        };

        $url = array_unique($generateUrl($this->model->all(), $root));

        return implode($url, '/');
    }

    private function parsePageTree($pages, $parentId = 0)
    {
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