require([
    'jquery',   
], function($){
    $('.influencer-affiliate-lp #accordion-faq .panel-collapse').hide();
    $(document.body).on('click', '.influencer-affiliate-lp [data-toggle="collapse"]', function(event) {
        var $this = $(this);
        var targetId = $this.attr('data-target') || $this.attr('href');
        if (!targetId) {
            return;
        }
        event.preventDefault();
        var parent = $this.attr('data-parent');
        if (parent) {
            $(parent).find('> .panel > .panel-heading > panel-title > [data-toggle="collapse"]').removeClass('collapsed active');
            $(parent).find('> .panel > .panel-collapse').hide().removeClass('in');
            $this.addClass('collapsed active');
            if ($(targetId).length) {
                $(targetId).show();
            } else {
                $this.closest('.panel-default').find('.panel-collapse').show().addClass('in');
            }
        } else {
            $this.toggleClass('active');
            if ($this.hasClass('active')) {
                $(targetId).show();
            } else {
                $(targetId).hide();
            }
        }
    });
});
