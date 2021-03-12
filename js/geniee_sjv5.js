(function() {
    var p = document.URL;if(p.indexOf("corez18c24-mili777") != -1) {return;}
    var gfparam = window.__gnsj;
    var ext_param = window.__gsj_ext_param;
    if(typeof gfparam != "undefined") {
        var banner_height = 600;
        var cw = gfparam["contents_width"];
        var em = gfparam["extra_margin"] || 0;
        var hcw = cw / 2;
        var t1 = document.getElementById("g_floating_area1");
        var t2 = document.getElementById("g_floating_area2");
        var top_pos = gfparam["top_pos"] || 0;
        if(top_pos != 0) {
            t1.style.top = top_pos + "px";
            t2.style.top = top_pos + "px";
            t1.style.position = "absolute";
            t2.style.position = "absolute";
            var s = document.body.style;
           if(typeof ext_param == "undefined" || ext_param["scleft"] == true) {
               removeExtraScroll(s);
           }
            var ch =0;
            addEvent(window, "load", function(){
                //ch = document.body.clientHeight || document.body.scrollHeight;
                ch = Math.max.apply( null, [document.body.clientHeight , document.body.scrollHeight, document.documentElement.scrollHeight, document.documentElement.clientHeight] );
            });
            var footer_pos = gfparam["footer_pos"] || 0;
            addEvent(window, "scroll", function() {
                //ch = document.body.clientHeight || document.body.scrollHeight;
                ch = Math.max.apply( null, [document.body.clientHeight , document.body.scrollHeight, document.documentElement.scrollHeight, document.documentElement.clientHeight] );
                scl_top = document.body.scrollTop || document.documentElement.scrollTop;
                var ua = navigator.userAgent;
                var is_sp_req = (ua.search(/Android/) != -1) || (ua.search(/iPhone/) != -1) || (ua.search(/iPod/) != -1) || (ua.search(/iPad/) != -1);
                if(!is_sp_req) {
                    if(typeof document.body.scrollLeft != "undefined") {
                        if(typeof ext_param == "undefined" || ext_param["scleft"] == true) {
                            document.body.scrollLeft = 0;
                        }
                    }else if(typeof document.documentElement.scrollLeft != "undefined") {
                        document.documentElement.scrollLeft = 0;
                    }
                }
                if(top_pos <= scl_top) {
                    if(scl_top >= ch - footer_pos - banner_height) {
                        t1.style.top = ch-footer_pos-banner_height +"px" || 0;
                        t2.style.top = ch-footer_pos-banner_height +"px" || 0;
                        t1.style.position = "absolute";
                        t2.style.position = "absolute";
                    }else {
                        t1.style.top = 0;
                        t2.style.top = 0;
                        t1.style.position = "fixed";
                        t2.style.position = "fixed";
                    }
                }else {
                    t1.style.top = top_pos +"px" || 0;
                    t2.style.top = top_pos +"px" || 0;
                    t1.style.position = "absolute";
                    t2.style.position = "absolute";
                }
            });
        } 
        t1.style.marginRight = hcw + em + "px";
        t2.style.marginLeft  = hcw + em + "px";
        t1.style.position = "fixed";
        t2.style.position = "fixed";
        t1.style.display = "block";
        t2.style.display = "block";
    }
    function isIE7() {
        return typeof window.addEventListener == "undefined" && typeof document.querySelectorAll == "undefined";
    }
    function removeExtraScroll(s) {
        if(isIE7()) {
            s.overflowX = "hidden";
            s.position = "relative";
        }else if(typeof s.overflowX != "undefined") {
            s.overflowX = "hidden" 
        }else {
            s += ";overflow: auto;";
        }
    }
    function addEvent(obj, ev, func) {
        var eventlistener = obj.addEventListener;
        var attevent = obj.attachEvent;
        if(eventlistener) {
            eventlistener(ev, func, false);
        }else if(attevent) {
            attevent('on' + ev, func);
        }
    }
})();
