/*jshint browser:true */
/*!
* FitVids 1.1
* Copyright 2013, Chris Coyier - https://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/
$ = jQuery;
!(function(t) {
    "use strict";
    (t.fn.fitVids = function(e) {
        var i = { customSelector: null, ignore: null };
        if (!document.getElementById("fit-vids-style")) {
            var r = document.head || document.getElementsByTagName("head")[0],
                a =
                    ".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}",
                d = document.createElement("div");

            (d.innerHTML = '<p>x</p><style id="fit-vids-style">' + a + "</style>"),
                r.appendChild(d.childNodes[1]);
        }
        return (
            e && t.extend(i, e),
                this.each(function() {
                    var e = [
                        'iframe[src*="player.vimeo.com"]',
                        'iframe[src*="youtube.com"]',
                        'iframe[src*="youtube-nocookie.com"]',
                        'iframe[src*="kickstarter.com"][src*="video.html"]',
                        "object",
                        "embed"
                    ];
                    i.customSelector && e.push(i.customSelector);
                    var r = ".fitvidsignore";
                    i.ignore && (r = r + ", " + i.ignore);
                    var a = t(this).find(e.join(","));
                    (a = a.not("object object")),
                        (a = a.not(r)),
                        a.each(function() {
                            var e = t(this);
                            if (
                                !(
                                    e.parents(r).length > 0 ||
                                    ("embed" === this.tagName.toLowerCase() &&
                                        e.parent("object").length) ||
                                    e.parent(".fluid-width-video-wrapper").length
                                )
                            ) {
                                e.css("height") ||
                                e.css("width") ||
                                (!isNaN(e.attr("height")) && !isNaN(e.attr("width"))) ||
                                (e.attr("height", 9), e.attr("width", 16));
                                var i =
                                        "object" === this.tagName.toLowerCase() ||
                                        (e.attr("height") && !isNaN(parseInt(e.attr("height"), 10)))
                                            ? parseInt(e.attr("height"), 10)
                                            : e.height(),
                                    a = isNaN(parseInt(e.attr("width"), 10))
                                        ? e.width()
                                        : parseInt(e.attr("width"), 10),
                                    d = i / a;
                                if (!e.attr("name")) {
                                    var o = "fitvid" + t.fn.fitVids._count;
                                    e.attr("name", o), t.fn.fitVids._count++;
                                }
                                e
                                    .wrap('<div class="fluid-width-video-wrapper"></div>')
                                    .parent(".fluid-width-video-wrapper")
                                    .css("padding-top", 100 * d + "%"),
                                    e.removeAttr("height").removeAttr("width");
                            }
                        });
                })
        );
    }),
        (t.fn.fitVids._count = 0);
})(window.jQuery || window.Zepto);


