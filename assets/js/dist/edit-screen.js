!function(t){"use strict";t(document).ready(function(){t("#prefecture","#taro-geo-taxonomy-box").change(function(){var e=t("#city","#taro-geo-taxonomy-box"),o=e.attr("data-prefecture"),a=t(this).val();e.attr("data-prefecture",a),o!=a&&e.trigger("clear.geo.taro")});var e=t("#city","#taro-geo-taxonomy-box");e.tokenInput(function(){return TaroGeo.token+"&term_id="+t("#city").attr("data-prefecture")},{tokenLimit:1,preventDuplicates:!0,searchDelay:500}),e.bind("clear.geo.taro",function(){t(this).tokenInput("clear")});var o=e.attr("data-id"),a=e.attr("data-name");o&&a&&e.tokenInput("add",{id:parseInt(o,10),name:a}),t(".taro-zip-search").click(function(o){o.preventDefault(),t.get(TaroGeo.zip,{zip:t("#zip").val()}).done(function(o){if(o.prefecture){var a=!1;t("option","#prefecture").each(function(e,n){t(n).text()===o.prefecture&&(t(n).attr("selected",!0),a=!0)}),a&&t("#prefecture").trigger("change")}o.city&&e.tokenInput("add",o.city),o.street&&t("#street").val(o.street)})}),function(){function e(t){r.lat=t.lat(),r.lng=t.lng(),n.map.setCenter(t),n.map.panTo(t)}function o(e){t("#lat").val(e.lat()),t("#lng").val(e.lng())}var a,n,r={lat:35.686573,lng:139.742216},i=t("#taro-gmap-container");if(i.length){var l=t("#lat").val(),g=t("#lng").val(),c=/^[0-9\.]+$/;c.test(l)&&c.test(g)&&(r.lat=parseFloat(l),r.lng=parseFloat(g)),a=new google.maps.Map(i.get(0),{center:new google.maps.LatLng(r.lat,r.lng),zoom:15,minZoom:11,mapTypeId:google.maps.MapTypeId.ROADMAP,zoomControlOptions:{position:google.maps.ControlPosition.LEFT_CENTER}}),n=new google.maps.Marker({position:new google.maps.LatLng(r.lat,r.lng),map:a,draggable:!0,animation:google.maps.Animation.DROP}),google.maps.event.addListener(n,"dragend",function(){e(this.position),o(this.position)}),google.maps.event.addListener(n,"drag",function(){o(this.position)}),t("#taro-geo-clearer").click(function(e){e.preventDefault(),t("#lat").val(""),t("#lng").val("")});var p=new google.maps.Geocoder;t("#taro-geo-searcher").click(function(a){a.preventDefault();var r=t("#prefecture option:selected").text(),i=t("#city").tokenInput("get"),l=t("#street").val();if(r.length&&i.length&&l.length){var g=[r,i[0].name.replace(/（.*）/,""),l].join(" ");p.geocode({address:g},function(t,a){console.log(g,t),a==google.maps.GeocoderStatus.OK?(n.setPosition(t[0].geometry.location),e(t[0].geometry.location),o(t[0].geometry.location)):alert("住所が見つかりません: "+a)})}else alert("住所が入力されていません")})}}()})}(jQuery);
//# sourceMappingURL=map/edit-screen.js.map