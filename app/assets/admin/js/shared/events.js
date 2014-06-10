(function($, window, document, undefined) {
    function randomHash(length) {
        var length = length || 5
        var text = '';
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < length; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

    function EventMaker() {
        this.init();
    }

    EventMaker.prototype.init = function() {
        this.bindPlugins();
        this.watchAddButton();
        this.watchDeleteButton();
    }

    EventMaker.prototype.bindPlugins = function() {
        // initialize input widgets first
        $('#events .time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:ia'
        });

        $('#events .date').datepicker({
            'format': 'mm/dd/yy',
            'autoclose': true,
            'forseParse': false,
        });

        // initialize datepair
        $('#events').datepair();
    }

    EventMaker.prototype.addEvent = function() {
        var rand = randomHash();

        var html = '<div class="col-md-6 push-bottom">';
        html += '<div class="panel panel-body flush-bottom event-box">';
        html += '<button data-toggle="modal" data-target="#event-delete-modal" type="button" class="close" aria-hidden="true">&times;</button>';
        html += '<div class="form-group">'
        html += '<label>Name</label>';
        html += '<input type="text" name="events[' + rand + '][name]" class="form-control" />';
        html += '</div>'; // end form group
        html += '<div class="row">';
        html += '<div class="col-md-6">';
        html += '<div class="form-group">'
        html += '<label>Start Date</label>';
        html += '<input type="text" name="events[' + rand + '][start_date]" class="form-control date" />';
        html += '</div>'; // end form group
        html += '</div>'; // end col 6
        html += '<div class="col-md-6">';
        html += '<div class="form-group">'
        html += '<label>End Date</label>';
        html += '<input type="text" name="events[' + rand + '][end_date]" class="form-control date" />';
        html += '</div>'; // end form group
        html += '</div>'; // end col 6
        html += '</div>'; // end row
        html += '<div class="row">';
        html += '<div class="col-md-6">';
        html += '<div class="form-group">'
        html += '<label>Start Time</label>';
        html += '<input type="text" name="events[' + rand + '][start_time]" class="form-control time" />';
        html += '</div>'; // end form group
        html += '</div>'; // end col 6
        html += '<div class="col-md-6">';
        html += '<div class="form-group">'
        html += '<label>End Time</label>';
        html += '<input type="text" name="events[' + rand + '][end_time]" class="form-control time" />';
        html += '</div>'; // end form group
        html += '</div>'; // end col 6
        html += '</div>'; // end row
        html += '<div class="form-group ">';
        html += '<label>Description</label>';
        html += '<textarea class="form-control" rows="3" name="events[' + rand + '][description]"></textarea>';
        html += '</div>'; // end form group
        html += '<div class="checkbox">';
        html += '<label>';
        html += '<input name="events[' + rand + '][recurring]" type="checkbox"> Recurring event?'
        html += '</label>';
        html += '</div>'; // end checkbox
        html += '</div>'; // end panel
        html += '</div>'; // end col 6

        $('#events > .row').append(html);
        this.bindPlugins();
    };

    EventMaker.prototype.watchAddButton = function() {
        var self = this;
        $('#event-add').on('click', function(e) {
            e.preventDefault();
            self.addEvent();
        });
    }

    EventMaker.prototype.watchDeleteButton = function() {
        var self = this;

        $(document).on('click', '.event-box .close', function(e) {
            e.preventDefault();
            self.el = $(this);
            self.parent = self.el.closest('.event-box');
        });

        $(document).on('click', '#event-delete-modal .delete-button', function() {
            var idAttr = self.parent.attr('data-id');

            $('#event-delete-modal').modal('hide');

            if (idAttr) {
                self.el.hide();
                self.parent.addClass('faded');
                $('input, textarea', self.parent).prop('disabled', true);

                var html = '<input type="hidden" name="delete_events[]" value="' + self.parent.attr('data-id') + '" />';
                $('#events').append(html);
            } else {
                self.parent.remove();
            }
        });
    }

    window.EventMaker = EventMaker;

})(jQuery, window, document);