$(function() {
    //Aqui vai todo nosso codigo jquery tambem poderia ser $(document).ready(function(){
    //
    //});

    var map;

    function intialize() {
        var mapProp = {
            center: new google.maps.LatLng(-3.816210, -38.492930),
            zoom: 14,
            scrollwheel: false,
            styles: [{
                stylers: [{
                    saturation: -100
                }]
            }],
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("map"), mapProp);
    }

    function addMarker(lat, long, icon, content, showInfoWindow, openInfoWindow) {
        var myLatlng = { lat: lat, lng: long };

        if (icon === '') {
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: icon
            });
        } else {
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: icon
            });
        }

        var InfoWindow = new google.maps.InfoWindow({
            content: content,
            maxWidth: 200
        });

        google.maps.event.addListener(InfoWindow, 'domready', function() {

            var iwOuter = $('.gm-style-iw');

            var iwbackground = iwOuter.prev();

            iwbackground.children(':nth-child(2)').css({ 'background': 'rgb(255,255,255' }).css({ 'border-radius': '0px' });

            iwbackground.children(':nth-child(4)').css({ 'background': 'rgb(255,255,255' }).css({ 'border-radius': '0px' });

            iwbackground.children(' :nth-child(1)').attr('style', function(i, s) {
                return s + 'display:none'
            });

            iwbackground.children(' :nth-child(3)').attr('style', function(i, s) {
                return s + 'display:none'
            });

            if (showInfoWindow == undefined) {
                google.maps.event.addListener(marker, 'click', function() {
                    InfoWindow.opne(map, marker);
                });
            } else if (openInfoWindow == true) {
                infoWindow.open(map, marker);
            }



        });

    }

    $("nav.mobile").click(function() {
        var listaMenu = $("nav.mobile ul");
        // if (listaMenu.is(':hidden') == true) {
        //     listaMenu.fadeIn();
        // } else {
        //     listaMenu.fadeOut();
        // }
        if (listaMenu.is(":hidden") == true) {
            //fa fa-times
            //fa fa-bars
            var icone = $(".botao-menu-mobile").find('i');
            icone.removeClass('fa-bars');
            icone.addClass('fa-times');
            console.log(icone);
            listaMenu.slideToggle();
        } else {
            var icone = $(".botao-menu-mobile i");
            icone.removeClass("fa-times");
            icone.addClass("fa-bars");
            listaMenu.slideToggle();
        }

    });

    if ($('target').length > 0) {
        // o elemento existe,portanto precisamos dar o scroll em algum elemento.
        var elemento = '#' + $('target').attr('target');
        var divScroll = $(elemento).offset().top;
        $('html,body').animate({ 'scrollTop': divScroll })
    }


    carregarDinamico();

    function carregarDinamico() {

        $('[realtime]').click(function() {
            var pagina = $(this).attr('realtime');

            console.log(pagina);
            $('.container-principal').hide();
            $('.container-principal').load(include_path + 'pages/' + pagina + '.php');

            setTimeout(function() {
                intialize();

                addMarker(-3.816210, -38.492930, '', "Minha Casa", undefined, true);
            }, 1000);

            $('.container-principal').fadeIn(1000);
            window.history.pushState('', '', pagina);

            return false;
        });
    }

});