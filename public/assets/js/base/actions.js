var timer = new Timer({
    autoStart: config.timer.autoStart,
    refreshDelay: 1000,
    showMsec: false,
    resetOnStop: false,

    onStop: function(){
        // alert('Send the last run');
    }
});


    
$(document).ready(function () {

    // Sticky
    // $(".sidebar").stick({
    //     offset: 100
    // });

    // Materialize Select
    $('select').material_select();
    

    // Table Order
    // $('table')
    //     .dynatable({
    //     features: {
    //       paginate: false,
    //       search: false,
    //       recordCount: false
    //     }});
    

    $('body').on('click', '[data-action]', function (e) {
        e.preventDefault();
        
        var action = $(this).data('action');
        var $this = $(this);
        
        switch (action) {
            
            /*-------------------------------------------
                Mainmenu and Notifications open/close
            ---------------------------------------------*/
            
            /* Toggle Sidebar */
            case 'toggle-sidebar':
                // alert('toggle sidebar');
                $('body').toggleClass('sidebar-hidden');
                
                break;
            



            /*-------------------------------------------
                Mainmenu and Notifications open/close
            ---------------------------------------------*/
            
            // /* Open Sidebar */
            // case 'sidebar-open':
                
                
            //     var target = $(this).data('ma-target');

            //     $this.addClass('toggled');
            //     $('#main').append('<div data-ma-action="sidebar-close" class="sidebar-backdrop animated fadeIn" />')
                
            //     if (target == 'main-menu') {
            //         $('#s-main-menu').addClass('toggled');
            //     }
            //     if (target == 'user-alerts') {
            //         $('#s-user-alerts').addClass('toggled');
            //     }

            //     $('body').addClass('o-hidden');
                
            //     break;
            
            // /* Close Sidebar */
            // case 'sidebar-close':
                
            //     $('[data-ma-action="sidebar-open"]').removeClass('toggled');
            //     $('.sidebar').removeClass('toggled');
            //     $('.sidebar-backdrop').remove();
            //     $('body').removeClass('o-hidden');
                
            //     break;
            

            
            /*----------------------------------
                Header Search
            -----------------------------------*/
            
            // /* Clear Search */
            // case 'search-clear':
                
            //     /* For mobile only */
            //     $('.h-search').removeClass('toggled');
        
            //     /* For all */
            //     $('.hs-input').val('');
            //     $('.h-search').removeClass('focused');
                
            //     break;
            
            // /* Open search */
            // case 'search-open':
                
            //     $('.h-search').addClass('toggled');
            //     $('.hs-input').focus();
        
            //     break;
            

            
            /*----------------------------------
                Main menu
            -----------------------------------*/
            
            /* Toggle Sub menu */
            case 'submenu-toggle':

                $this.next().slideToggle(200);
                $this.parent().toggleClass('open');
                
                break;
                
    
                
            /*----------------------------------
                Table Row Link
            -----------------------------------*/
            
            /* Toggle Sub menu */
            case 'row-link':

                // alert( $this.data('href') );
                window.location = $this.data('href');
                
                break;



            /*----------------------------------
                 Messages
            -----------------------------------*/
            // case 'message-toggle':

            //     $('.ms-menu').toggleClass('toggled');
            //     $this.toggleClass('toggled');

            //     break;



            /*-------------------------------------------------
                Action Header Search (used in listview.html)
             -------------------------------------------------*/

            // //Open action header search
            // case 'ah-search-open':
            //     x = $(this).closest('.action-header').find('.ah-search');

            //     x.fadeIn(300);
            //     x.find('.ahs-input').focus();

            //     break;

            // //Close action header search
            // case 'ah-search-close':
            //         x.fadeOut(300);
            //         setTimeout(function(){
            //             x.find('.ahs-input').val('');
            //         }, 350);

            //     break;

        }
    }); 
});
