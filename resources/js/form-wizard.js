<<<<<<< HEAD

! function(a) {
    "function" != typeof String.prototype.startsWith && (String.prototype.startsWith = function(a) {
        return 0 === this.indexOf(a)
    }), "function" != typeof String.prototype.endsWith && (String.prototype.endsWith = function(a) {
        return -1 !== this.indexOf(a, this.length - a.length)
    });
    var b = function(b) {
            this.selector = b;
            var c = this,
                d = {
                    getValue: function() {
                        var b = null,
                            d = c.selector,
                            e = "#" + d,
                            f = 'input[name="' + d + '"]:checked',
                            g = 'input[name="' + d + '[]"]:checked',
                            h = "";
                        switch (!0) {
                            case a("select" + e).length > 0:
                                h = "select" + e;
                                var i = a(e).val();
                                b = a.isArray(i) && 1 === i.length ? i[0] : i;
                                break;
                            case a(e).length > 0:
                                h = e, b = a(e).val();
                                break;
                            case a(f).length > 0:
                                h = f, b = a(f).val();
                                break;
                            case a(g).length > 0:
                                h = g;
                                var j = a(g).map(function() {
                                    return this.value
                                }).get();
                                b = 1 === j.length ? j[0] : j
                        }
                        return console.log("The value of " + h + " is : ", b), b
                    },
                    $container: function() {
                        var b = a.map(c.selector.split(","), function(a) {
                            return "div." + a
                        });
                        return a(b.join(","))
                    },
                    trigger: function(b) {
                        a(document).trigger(b, c)
                    },
                    $field: function() {
                        var b = a.map(c.selector.split(","), function(a) {
                            return "#" + a
                        });
                        return a(b.join(","))
                    }
                },
                e = {
                    show: function() {
                        d.$container().show("slow"), d.trigger("logic:show")
                    },
                    hide: function() {
                        d.$container().hide("slow"), d.trigger("logic:hide")
                    },
                    jumpTo: function() {
                        try {
                            a.scrollTo(d.$container(), 800), d.$field().focus()
                        } catch (b) {}
                        d.trigger("logic:jumpTo")
                    },
                    _disable: function(a) {
                        a.addClass("jf-disabled"), a.find(":input").prop("disabled", !0).addClass("tmp-disabled")
                    },
                    disable: function() {
                        d.$container().each(function() {
                            e._disable(a(this))
                        }), d.trigger("logic:disable")
                    },
                    _enable: function(a) {
                        a.removeClass("jf-disabled"), a.find(":input.tmp-disabled").prop("disabled", !1).removeClass("tmp-disabled")
                    },
                    enable: function() {
                        d.$container().each(function() {
                            e._enable(a(this))
                        }), d.trigger("logic:enable")
                    },
                    toggleVisibility: function(a) {
                        a ? e.show() : e.hide()
                    },
                    toggleEnable: function(a) {
                        a ? e.enable() : e.disable()
                    },
                    requiredDepends: function(b) {
                        b ? d.$container().addClass("required") : d.$container().removeClass("required"), d.$field().each(function() {
                            var c = a(this);
                            c.rules("add", {
                                required: {
                                    depends: function() {
                                        return b
                                    }
                                }
                            }), c.valid()
                        })
                    }
                };
            return this["public"] = {
                show: e.show,
                hide: e.hide,
                disable: e.disable,
                enable: e.enable,
                jumpTo: e.jumpTo,
                toggleVisibility: e.toggleVisibility,
                toggleEnable: e.toggleEnable,
                requiredDepends: e.requiredDepends,
                value: d.getValue(),
                $field: d.$field(),
                $container: d.$container()
            }, this["public"]
        },
        c = function(c) {
            this.disabled = c && c.disabled || !1, this.selector = c && c.selector || "", this.condition = c && c.condition || "", this.value = c && c.value || "";
            var d = this,
                e = !1,
                f = new b(d.selector),
                g = function(b) {
                    var c = a.trim(f.value).toLowerCase(),
                        e = a.trim(d.value).toLowerCase(),
                        g = -1 !== a.inArray(d.value, f.value);
                    switch (b) {
                        case "==":
                            return c == e || g;
                        case "!=":
                            return c != e || !g;
                        case "contains":
                            return -1 !== c.indexOf(e) || g;
                        case "not contains":
                            return -1 === c.indexOf(e) || !g;
                        default:
                            return c[b](e)
                    }
                },
                h = {
                    "==": function() {
                        return e = g("==")
                    },
                    "!=": function() {
                        return e = g("!=")
                    },
                    "begins with": function() {
                        return e = g("startsWith")
                    },
                    "ends with": function() {
                        return e = g("endsWith")
                    },
                    contains: function() {
                        return e = g("contains")
                    },
                    "not contains": function() {
                        return e = g("not contains")
                    }
                },
                i = function() {
                    return e
                },
                j = function() {
                    return d.disabled ? (e = !0, !0) : e = h[d.condition]()
                };
            this.validate = j, this.isValid = i
        },
        d = function(a) {
            this.disabled = a && a.disabled || !1, this.action = a && a.action || "", this.selector = a && a.selector || "", this.match = a && a.match || "", this.rules = a && a.rules || [];
            var d = this,
                e = !1,
                f = new b(d.selector),
                g = (f.$field, f.$container, []),
                h = {
                    all: function() {
                        for (var a = !0, b = 0, c = g.length; c > b; b++) a = a && g[b].isValid();
                        return a
                    },
                    any: function() {
                        for (var a = 0, b = g.length; b > a; a++)
                            if (g[a].isValid()) return !0;
                        return !1
                    },
                    none: function() {
                        for (var a = !0, b = 0, c = g.length; c > b; b++) a = a && !g[b].isValid();
                        return a
                    }
                },
                i = {
                    show: function(a) {
                        a && f.show()
                    },
                    hide: function(a) {
                        a && f.hide()
                    },
                    "jump to": function(a) {
                        a && f.jumpTo()
                    },
                    toggleEnable: function(a) {
                        f.toggleEnable(a)
                    },
                    toggleVisibility: function(a) {
                        f.toggleVisibility(a)
                    },
                    requiredDepends: function(a) {
                        f.requiredDepends(a)
                    },
                    disable: function(a) {
                        a && f.disable()
                    },
                    enable: function(a) {
                        a && f.enable()
                    }
                },
                j = function() {
                    g = [];
                    for (var a = 0, b = d.rules.length; b > a; a++) {
                        var e = new c(d.rules[a]);
                        e.disabled ? console.log("ignore disabled rule: ", d.rules[a]) : g.push(e)
                    }
                },
                k = function() {
                    if (d.disabled) return console.log("ignore disabled logic"), !0;
                    for (var a = 0, b = g.length; b > a; a++) g[a].validate();
                    l()
                },
                l = function() {
                    return e = h[d.match](), console.log("going to " + d.action + " " + d.selector), i[d.action](e), e
                };
            j(), this.validate = k, this.isValid = e
        },
        e = function(a) {
            this.logics = a && a.logics || [];
            var b = this,
                c = [],
                e = function() {
                    var a, e, f;
                    for (c = [], a = 0, e = b.logics.length; e > a; a++) f = new d(b.logics[a]), f.disabled || c.push(f)
                },
                f = function() {
                    e(), console.log("Logics", c);
                    for (var a = 0, b = c.length; b > a; a++) c[a].validate()
                };
            return {
                validate: f
            }
        };
    a.formlogic = function(a) {
        var b = new e(a);
        b.validate()
    }, a.formlogic.field = function(a) {
        return new b(a)
    }
}(jQuery),
function(a) {
    var b, c, d = 1,
        e = a(".actions li.previous"),
        f = a(".actions li.next"),
        g = a(".actions .previous > a"),
        h = a(".actions .next > a"),
        i = a(".actions .numberText > label"),
        j = a("div.submit"),
        k = a(".stepBar .progress-bar"),
        l = k.find("label"),
        m = progressDefaultText = l.text(),
        n = function(a) {
            return a.replace("{page}", d).replace("{total}", b)
        },
        o = function(a) {
            d > a ? p(a) : q(a)
        },
        p = function(a) {
            for (var b = a; b > 0; b--) {
                var c = v(b);
                if (!c.hidden) return r(b)
            }
        },
        q = function(a) {
            for (var c = a; b >= c; c++) {
                var d = v(c);
                if (!d.hidden) return r(c)
            }
        },
        r = function(c) {
            if (!(1 > c || c > b)) {
                d = c;
                var e = v(d);
                m = "" == e.progressText ? progressDefaultText : e.progressText, a(".steps li").removeClass("current"), e.$e.addClass("current"), g.text(n(e.labelPrevious)), h.text(n(e.labelNext)), i.text(n(e.labelNumberText)), a("section.page").removeClass("current").hide(), a("section.page:eq(" + (d - 1) + ")").addClass("current").show("slow"), s(), t()
            }
        },
        s = function() {
            switch (!0) {
                case 1 == d:
                    e.hide(), f.show(), j.hide();
                    break;
                case d == b:
                    e.show(), f.hide(), j.show();
                    break;
                default:
                    e.show(), f.show(), j.hide()
            }
        },
        t = function() {
            var a = (d - 1) / b * 100 + "%",
                c = k.find("label"),
                e = m.replace("{percent}", a);
            c.text(e), k.css("width", a).attr("aria-valuenow", a)
        },
        u = function(a) {
            return a.charAt(0).toUpperCase() + a.slice(1)
        },
        v = function(b) {
            var c = {
                    step: 1,
                    fid: "",
                    hidden: !1,
                    labelPrevious: "Previous",
                    labelNext: "Next",
                    progressText: "",
                    labelNumberText: "",
                    disabled: !1
                },
                d = a('li[data-page-step="' + b + '"]');
            if (!d.length) return c;
            for (var e in c) {
                var f = d.data("page" + u(e));
                c[e] = f ? f : ""
            }
            return c.$e = d, c
        },
        w = function() {
            o(d - 1)
        },
        x = function() {
            var b = c.formId;
            return b ? a(b).valid() : !0
        },
        y = function() {
            x() && o(d + 1)
        },
        z = function() {
            0 != a(".steps").length && (b = a(".steps > li").length, o(1), g.click(function(a) {
                return a.preventDefault(), w(), !1
            }), h.click(function(a) {
                return a.preventDefault(), y(), !1
            }))
        },
        A = function() {
            function b(b, c) {
                if (c.hasClass("page")) {
                    var d = c.attr("id"),
                        e = a('li[data-page-fid="' + d + '"'),
                        f = v(e.data("pageStep"));
                    switch (b) {
                        case "logic:show":
                            e.data("pageHidden", !1).attr("data-page-hidden", !1), e.show("slow");
                            break;
                        case "logic:hide":
                            e.data("pageHidden", !0).attr("data-page-hidden", !0), e.hide("slow");
                            break;
                        case "logic:jumpTo":
                            x() && (e.show("slow"), o(f.step));
                            break;
                        case "logic:enable":
                            break;
                        case "logic:disable":
                    }
                }
            }

            function d(c, d) {
                var e = d["public"];
                e.$field.each(function() {
                    var d = a(this);
                    b(c.type, d)
                })
            }
            a(document).on("JF.ready", function(a, b) {
                c = b, z()
            }), a(document).on("logic:show logic:hide logic:jumpTo logic:enable logic:disable", d)
        };
    a.fn.formSteps = function(b) {
        return a.fn.formSteps[b] ? a.fn.formSteps[b].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof b && b ? void a.error("Method " + b + " does not exist on jQuery.formSteps") : initialize.apply(this, arguments)
    }, a.fn.formSteps.init = A, a.fn.formSteps.getStep = v, a.fn.formSteps.gotoStep = o
}(jQuery), $("body").formSteps("init"),
    function(a) {
        function b(b, c) {
            if (b.length) {
                c || (c = window);
                var d = !1,
                    e = function() {
                        if (!d) {
                            d = !0;
                            var e = a(c).width();
                            b.each(function(b, c) {
                                var d, f = a(c),
                                    g = f[0];
                                return !g.complete || "undefined" != typeof g.naturalWidth && 0 == g.naturalWidth ? !1 : (f.data("origwidth") || f.data("origwidth", g.naturalWidth), d = f.data("origwidth") > e - 40 ? "100%" : f.data("origwidth") + "px", void f.css("width", d))
                            }), d = !1
                        }
                    };
                e(), a(window).resize(e)
            }
        }
        a.setResponsiveToImages = b
    }(jQuery),
    function(a) {
        function b(a, b, c, d) {
            d = parseFloat(d), d = isNaN(d) ? 0 : d, a instanceof Date && b instanceof Date ? (a = a.getTime(), b = b.getTime(), d = 864e5 * d) : (a = parseFloat(a), a = isNaN(a) ? 0 : a, b = parseFloat(b), b = isNaN(b) ? 0 : b);
            var e;
            switch (c) {
                case ">":
                    e = a > b + d;
                    break;
                case "<":
                    e = b + d > a;
                    break;
                case ">=":
                    e = a >= b + d;
                    break;
                case "<=":
                    e = b + d >= a;
                    break;
                case "!=":
                    e = a != b + d;
                    break;
                case "=":
                case "==":
                    e = a == b + d
            }
            return e
        }
        jQuery.validator.addMethod("compareTo", function(c, d) {
            var e = !0,
                f = a(d),
                g = f.data("rule-compareto"),
                h = f.data("rule-compareto-method"),
                i = f.data("rule-compareto-diff"),
                j = f.data("rule-compareto-type"),
                k = f.val(),
                l = a(g).val();
            return "" == l ? !0 : ("date" == j && (k = new Date(k), l = new Date(l)), e = b(k, l, h, i))
        }, "Failed to compare two fields")
    }(jQuery),
    function() {
        function a() {
            var a = window.location.href.indexOf("?");
            if (-1 !== a) {
                var b = window.location.href.slice(a + 1),
                    c = deparam(b);
                $.each(c, function(a, b) {
                    try {
                        $("#" + a + ',[name="' + a + '"],[name="' + a + '[]"]').each(function() {
                            var a = $(this),
                                c = a.val();
                            switch (!0) {
                                case a.is(":checkbox"):
                                case a.is(":radio"):
                                    if (c == b || -1 !== $.inArray(c, b)) {
                                        a.prop("checked", !0);
                                        try {
                                            a.iCheck("update")
                                        } catch (d) {}
                                    }
                                    break;
                                case a.is("select"):
                                    a.select2 ? a.select2("val", b) : a.val(b);
                                    break;
                                default:
                                    a.val(b)
                            }
                        })
                    } catch (c) {}
                })
            }
        }

        function b(a) {
            var b = $(a),
                c = b.attr("action"),
                d = -1 == c.indexOf("?") ? "?" : "&",
                e = c + d + "method=csrfToken";
            $.get(e, function(a) {
                try {
                    a = $.parseJSON(a)
                } catch (c) {
                    return
                }
                "undefined" != typeof a.csrf_token && $("<input>").attr({
                    type: "hidden",
                    id: "csrf_token",
                    name: "csrf_token",
                    value: a.csrf_token
                }).appendTo(b)
            })
        }

        function d() {
            var a = function() {
                var a = $(this),
                    b = a.closest("div.form-group"),
                    c = b.find("input.jf-has-box");
                c.each(function() {
                    var b = $(this).attr("id") + "_box",
                        c = $("#" + b);
                    $(this).is(":checked") && c.show(), a.attr("id") + "_box" == b && c.focus()
                })
            };
            $(".jf-form").on({
                click: a,
                handleOptionBox: a
            }, ".jf-has-box"), $(".jf-option-box").blur(function() {
                var a = String($(this).attr("id")).replace("_box", "");
                "" == $.trim($(this).val()) && $("#" + a).attr("checked", !1), $("#" + a).val($(this).val()).trigger("change")
            })
        }

        function f(a) {
            var b = function(b) {
                    var c = $(b),
                        d = c.is("input.form-control") || c.is("select.form-control") || c.is("textarea.form-control"),
                        e = c.closest("div.form-group").find(".file-input-new");
                    c.closest("div.form-group").addClass("bg-info has-error" + (d ? " has-feedback" : "")), c.is(":visible") && d && !c.data("glyphicon") && ($('<span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>').insertAfter(c), c.data("glyphicon", !0), setTimeout(function() {
                        var a, b = c.height(),
                            d = c.width();
                        switch (!0) {
                            case e.length >= 1:
                                a = c.closest("div.form-group").find("div.file-caption").offset();
                                break;
                            case c.hasClass("select2-hidden-accessible"):
                                var f = c.closest("div.form-group").find(".select2-container");
                                b = f.height() - 2, d = f.width() - 50, a = f.offset(), console.log("select2", a, f);
                                break;
                            default:
                                a = c.offset()
                        }
                        var g = c.closest("div.form-group").find("span.glyphicon-warning-sign"),
                            h = {
                                top: a.top + (b - g.height()) / 2 + 4,
                                left: a.left + d + 10
                            };
                        g.offset(h)
                    }, 50)), g($.Event("invalid-form"), $(a).data("validator"))
                },
                c = function(b) {
                    $(b).data("glyphicon", !1), $(b).closest("div.form-group").removeClass("bg-info has-error has-feedback").find("span.glyphicon,p.validation-error").remove(), g($.Event("invalid-form"), $(a).data("validator"))
                };
            $("input[type=file].form-control").on("fileloaded", function() {
                c(this, "", "")
            });
            var d = function(a, b) {
                    var c = $(b).closest("div.form-group").find("p.description");
                    c.length > 0 ? a.insertBefore(c) : a.appendTo($(b).closest("div.form-group"))
                },
                f = function() {
                    var a, b = $("#g-recaptcha").data("size"),
                        c = function() {
                            var a = function() {
                                    (!b || grecaptcha) && $("#g-recaptcha-response").length && ($("#g-recaptcha-response").rules("add", {
                                        required: !0
                                    }), b && grecaptcha.execute(), clearInterval(c))
                                },
                                c = setInterval(a, 800)
                        },
                        d = function() {
                            $("#g-recaptcha-response").length && ($("#g-recaptcha-response").valid(), a = !0)
                        };
                    return {
                        init: c,
                        checkRequired: function() {
                            a || setInterval(d, 800)
                        }
                    }
                }(),
                g = function(a, b) {
                    var c = b.numberOfInvalids();
                    c && ($("p.error").show(), f.checkRequired()), c = b.numberOfInvalids(), c || $("p.error").hasClass("server-error") || $("p.error").hide()
                },
                h = {},
                i = function(a) {
                    return $.each(h, function(b, c) {
                        var d = new RegExp("{" + b + "}", "gi");
                        a = a.replace(d, c)
                    }), a
                },
                j = function(a) {
                    var b = $(".jf-thankyou");
                    if (b.length) {
                        var c = $.trim(b.data("redirect"));
                        c = decodeURIComponent(c), a && a.serverRedirect && (c = a.serverRedirect);
                        var d = i(b.html());
                        b.html(d);
                        var e = function() {
                            if (parent) {
                                var a = ($("body > *:visible").height(), $(window.parent.document).find('iframe[src*="' + location.pathname + '"]'));
                                a.length > 0 && $(window.parent.document).find("html, body").animate({
                                    scrollTop: a.offset().top
                                }, 500)
                            }
                        };
                        if ("" === c) return b.show("slow"), void setTimeout(e, 500);
                        var f = parseInt(b.data("seconds"));
                        a && a["serverRedirect.setTimeout"] && (f = a["serverRedirect.setTimeout"]), f > 0 ? (b.show("slow"), setTimeout(e, 500)) : f = 0, setTimeout(function() {
                            c = i(c);
                            try {
                                parent && (parent.location.href = c)
                            } catch (a) {
                                location.href = c
                            }
                        }, 1e3 * f)
                    }
                },
                k = function() {
                    var a, b = $(".submit > button"),
                        c = $(".submit div.progress");
                    a = {
                        width: b.outerWidth(),
                        height: b.outerHeight()
                    };
                    var d = function() {
                            c.css(a).show(), b.prop("disabled", !0)
                        },
                        e = function() {
                            c.hide(), b.prop("disabled", !1)
                        };
                    return {
                        showProgressBar: d,
                        hideProgressBar: e
                    }
                },
                l = function(a) {
                    if (null === location.href.match(/^https*/) && null === $(a).attr("action").match(/^https*/)) return $("h4.local-submit").length || $("<h4 style='padding:16px;' class='bg-info local-submit'>Form submit does not work on local computer.<br>Please test it on your web server!</h4>").appendTo($(".jf-form")), !1;
                    var b = $(".submit p.error");
                    b.data("origMsg") || b.data("origMsg", b.html());
                    var c = [];
                    $(a).find("div.required").not(".jf-hide,.jf-disabled").each(function() {
                        c.push($(this).data("fid"))
                    }), $("#serverValidationFields").val(c.join(",")), b.removeClass("server-error"), $btn = new k, $btn.showProgressBar();
                    var d = function() {
                        var c = $(a).ajaxSubmit(),
                            d = c.data("jqxhr");
                        d.done(function(a) {
                            var c = !1;
                            try {
                                data = $.parseJSON(a)
                            } catch (d) {
                                c = !0, data = {
                                    validated: !1
                                }
                            }
                            data && data.validated === !0 ? ($(".jf-form").hide(), h = data.fieldValues, j(h)) : (c && b.text(a), b.addClass("server-error").show("slow"), $btn.hideProgressBar(), setTimeout(function() {
                                b.html(b.data("origMsg")), b.hide()
                            }, 5e3))
                        })
                    };
                    setTimeout(d(), 3e3)
                };
            $.validator.methods.required = function(a, b, c) {
                if (!this.depend(c, b)) return "dependency-mismatch";
                if ("select" === b.nodeName.toLowerCase()) {
                    var d = $(b).val();
                    return d && d.length > 0 && "" != d
                }
                return this.checkable(b) ? this.getLength(a, b) > 0 : $.trim(a).length > 0
            }, $.validator.methods.equalto = $.validator.methods.equalTo;
            var m = function() {
                    var a = $(this);
                    return a.hasClass("g-recaptcha-response") && !$("#g-recaptcha").is(":hidden") ? !1 : (yes = a.is(":hidden") || a.is(":input.tmp-disabled"), yes)
                },
                n = 0 === String($(a).data("licensekey")).toUpperCase().indexOf("JF-");
            n ? $(".jf-copyright").remove() : (e(), setInterval(e, 1e4)), $(a).validate({
                errorClass: "validation-error help-block bg-warning",
                errorElement: "p",
                ignore: m,
                highlight: b,
                unhighlight: c,
                invalidHandler: g,
                submitHandler: l,
                errorPlacement: d
            }), $(".g-recaptcha").length && f.init()
        }

        function g(a) {
            $.jMaskGlobals.watchDataMask = !0, $(a).each(function(a, b) {
                var c, d = {
                        autoclose: !0
                    },
                    e = $(b);
                $.each(["format", "weekStart", "startDate", "endDate", "startView", "minViewMode", "todayBtn", "clearBtn", "language", "orientation", "multidate", "multidateSeparator", "daysOfWeekDisabled", "calendarWeeks", "autoclose", "todayHighlight", "datesDisabled", "toggleActive", "defaultViewDate"], function(a, b) {
                    c = e.data("datepicker-" + b.toLowerCase()), c && (d[b] = "daysOfWeekDisabled" == b ? String(c) : c)
                }), e.datepicker(d).on("changeDate", function(a) {
                    $(a.target).valid()
                }), e.next(".input-group-addon.right").click(function() {
                    e.datepicker("show")
                })
            })
        }

        function h() {
            $("input[type=file].form-control").each(function(a, b) {
                var c = {
                        showUpload: !1,
                        autoReplace: !1,
                        overwriteInitial: !1,
                        initialPreviewShowDelete: !0,
                        uploadAsync: !1
                    },
                    d = $(b),
                    e = "showPreview,showRemove,showUpload,showZoom".split(","),
                    f = d.data("allowedfileextensions"),
                    g = d.data("multiple"),
                    h = d.data("browselabel"),
                    i = parseInt(d.data("maxfilecount")),
                    j = d.data("maxfilesize");
                i > 0 && (c.maxFileCount = i), g || (c.maxFileCount = 1), h && (c.browseLabel = h), f && (c.allowedFileExtensions = String(f).replace(/\s+/g, "").split(",")), j && (c.maxFileSize = parseFloat(String(j))), "undefined" != typeof fileinputLanguage && (c.language = fileinputLanguage);
                for (var a = 0, k = e.length; k > a; a++) {
                    var l = e[a],
                        m = /(false|0|no)/i,
                        n = m.test(String(d.data(l.toLowerCase())));
                    n && (c[l] = !1)
                }
                d.fileinput(c)
            }), setTimeout(function() {
                $("div.btn-file").removeClass("btn-primary").addClass("btn-default")
            }, 350)
        }
        var i = {};
        i.init = function(e) {
            c(), h(), g(".datepicker"), d(), f(e), b(e), a(), $(document).trigger("JF.ready", {
                formId: e
            }), $.setResponsiveToImages($(e).find("img"))
        }, $.formlogic && $.formlogic.field && (i.field = $.formlogic.field), window.JF = i
    }(),
    function() {
        function a(a, b) {
            for (var c, d = [], e = !1, f = !1, a = String(a).toLowerCase(), g = 0, h = b.length; h > g; g++) {
                c = b[g], ("undefined" == typeof c.value || "" == $.trim(c.value) || "null" == $.trim(c.value) || "undefined" == $.trim(c.value)) && (c.value = c.label);
                var i = "#depend" == c.label;
                if (i && String(c.value).toLowerCase() == a) e = !0;
                else {
                    if (i && e && String(c.value).toLowerCase() != a) {
                        f = !0;
                        break
                    }
                    e && d.push(c)
                }
            }
            return d
        }

        function b(b) {
            var c = d[b];
            if (c) {
                var e = c.options,
                    b = "#" + b,
                    f = "#" + c.dependOn;
                $(f).change(function() {
                    var c = $(this).val(),
                        d = a(c, e),
                        f = [];
                    $(b).empty();
                    for (var g = 0, h = d.length; h > g; g++) {
                        var i = d[g],
                            j = $.trim(i.value),
                            k = 'value="' + j.replace('"', "&quot;").replace("#empty", "").replace("#novalue", "") + '"';
                        f.push("<option " + k + ">" + i.label + "</option>")
                    }
                    $(b).append(f.join()), setTimeout(function() {
                        try {
                            $(b).select2("val", "")
                        } catch (a) {}
                    }, 300)
                })
            }
        }

        function c(a, c) {
            d = c;
            for (var e in d) d.hasOwnProperty(e) && b(e)
        }
        var d;
        $(document).on("dependent:setup", c)
=======

! function(a) {
    "function" != typeof String.prototype.startsWith && (String.prototype.startsWith = function(a) {
        return 0 === this.indexOf(a)
    }), "function" != typeof String.prototype.endsWith && (String.prototype.endsWith = function(a) {
        return -1 !== this.indexOf(a, this.length - a.length)
    });
    var b = function(b) {
            this.selector = b;
            var c = this,
                d = {
                    getValue: function() {
                        var b = null,
                            d = c.selector,
                            e = "#" + d,
                            f = 'input[name="' + d + '"]:checked',
                            g = 'input[name="' + d + '[]"]:checked',
                            h = "";
                        switch (!0) {
                            case a("select" + e).length > 0:
                                h = "select" + e;
                                var i = a(e).val();
                                b = a.isArray(i) && 1 === i.length ? i[0] : i;
                                break;
                            case a(e).length > 0:
                                h = e, b = a(e).val();
                                break;
                            case a(f).length > 0:
                                h = f, b = a(f).val();
                                break;
                            case a(g).length > 0:
                                h = g;
                                var j = a(g).map(function() {
                                    return this.value
                                }).get();
                                b = 1 === j.length ? j[0] : j
                        }
                        return console.log("The value of " + h + " is : ", b), b
                    },
                    $container: function() {
                        var b = a.map(c.selector.split(","), function(a) {
                            return "div." + a
                        });
                        return a(b.join(","))
                    },
                    trigger: function(b) {
                        a(document).trigger(b, c)
                    },
                    $field: function() {
                        var b = a.map(c.selector.split(","), function(a) {
                            return "#" + a
                        });
                        return a(b.join(","))
                    }
                },
                e = {
                    show: function() {
                        d.$container().show("slow"), d.trigger("logic:show")
                    },
                    hide: function() {
                        d.$container().hide("slow"), d.trigger("logic:hide")
                    },
                    jumpTo: function() {
                        try {
                            a.scrollTo(d.$container(), 800), d.$field().focus()
                        } catch (b) {}
                        d.trigger("logic:jumpTo")
                    },
                    _disable: function(a) {
                        a.addClass("jf-disabled"), a.find(":input").prop("disabled", !0).addClass("tmp-disabled")
                    },
                    disable: function() {
                        d.$container().each(function() {
                            e._disable(a(this))
                        }), d.trigger("logic:disable")
                    },
                    _enable: function(a) {
                        a.removeClass("jf-disabled"), a.find(":input.tmp-disabled").prop("disabled", !1).removeClass("tmp-disabled")
                    },
                    enable: function() {
                        d.$container().each(function() {
                            e._enable(a(this))
                        }), d.trigger("logic:enable")
                    },
                    toggleVisibility: function(a) {
                        a ? e.show() : e.hide()
                    },
                    toggleEnable: function(a) {
                        a ? e.enable() : e.disable()
                    },
                    requiredDepends: function(b) {
                        b ? d.$container().addClass("required") : d.$container().removeClass("required"), d.$field().each(function() {
                            var c = a(this);
                            c.rules("add", {
                                required: {
                                    depends: function() {
                                        return b
                                    }
                                }
                            }), c.valid()
                        })
                    }
                };
            return this["public"] = {
                show: e.show,
                hide: e.hide,
                disable: e.disable,
                enable: e.enable,
                jumpTo: e.jumpTo,
                toggleVisibility: e.toggleVisibility,
                toggleEnable: e.toggleEnable,
                requiredDepends: e.requiredDepends,
                value: d.getValue(),
                $field: d.$field(),
                $container: d.$container()
            }, this["public"]
        },
        c = function(c) {
            this.disabled = c && c.disabled || !1, this.selector = c && c.selector || "", this.condition = c && c.condition || "", this.value = c && c.value || "";
            var d = this,
                e = !1,
                f = new b(d.selector),
                g = function(b) {
                    var c = a.trim(f.value).toLowerCase(),
                        e = a.trim(d.value).toLowerCase(),
                        g = -1 !== a.inArray(d.value, f.value);
                    switch (b) {
                        case "==":
                            return c == e || g;
                        case "!=":
                            return c != e || !g;
                        case "contains":
                            return -1 !== c.indexOf(e) || g;
                        case "not contains":
                            return -1 === c.indexOf(e) || !g;
                        default:
                            return c[b](e)
                    }
                },
                h = {
                    "==": function() {
                        return e = g("==")
                    },
                    "!=": function() {
                        return e = g("!=")
                    },
                    "begins with": function() {
                        return e = g("startsWith")
                    },
                    "ends with": function() {
                        return e = g("endsWith")
                    },
                    contains: function() {
                        return e = g("contains")
                    },
                    "not contains": function() {
                        return e = g("not contains")
                    }
                },
                i = function() {
                    return e
                },
                j = function() {
                    return d.disabled ? (e = !0, !0) : e = h[d.condition]()
                };
            this.validate = j, this.isValid = i
        },
        d = function(a) {
            this.disabled = a && a.disabled || !1, this.action = a && a.action || "", this.selector = a && a.selector || "", this.match = a && a.match || "", this.rules = a && a.rules || [];
            var d = this,
                e = !1,
                f = new b(d.selector),
                g = (f.$field, f.$container, []),
                h = {
                    all: function() {
                        for (var a = !0, b = 0, c = g.length; c > b; b++) a = a && g[b].isValid();
                        return a
                    },
                    any: function() {
                        for (var a = 0, b = g.length; b > a; a++)
                            if (g[a].isValid()) return !0;
                        return !1
                    },
                    none: function() {
                        for (var a = !0, b = 0, c = g.length; c > b; b++) a = a && !g[b].isValid();
                        return a
                    }
                },
                i = {
                    show: function(a) {
                        a && f.show()
                    },
                    hide: function(a) {
                        a && f.hide()
                    },
                    "jump to": function(a) {
                        a && f.jumpTo()
                    },
                    toggleEnable: function(a) {
                        f.toggleEnable(a)
                    },
                    toggleVisibility: function(a) {
                        f.toggleVisibility(a)
                    },
                    requiredDepends: function(a) {
                        f.requiredDepends(a)
                    },
                    disable: function(a) {
                        a && f.disable()
                    },
                    enable: function(a) {
                        a && f.enable()
                    }
                },
                j = function() {
                    g = [];
                    for (var a = 0, b = d.rules.length; b > a; a++) {
                        var e = new c(d.rules[a]);
                        e.disabled ? console.log("ignore disabled rule: ", d.rules[a]) : g.push(e)
                    }
                },
                k = function() {
                    if (d.disabled) return console.log("ignore disabled logic"), !0;
                    for (var a = 0, b = g.length; b > a; a++) g[a].validate();
                    l()
                },
                l = function() {
                    return e = h[d.match](), console.log("going to " + d.action + " " + d.selector), i[d.action](e), e
                };
            j(), this.validate = k, this.isValid = e
        },
        e = function(a) {
            this.logics = a && a.logics || [];
            var b = this,
                c = [],
                e = function() {
                    var a, e, f;
                    for (c = [], a = 0, e = b.logics.length; e > a; a++) f = new d(b.logics[a]), f.disabled || c.push(f)
                },
                f = function() {
                    e(), console.log("Logics", c);
                    for (var a = 0, b = c.length; b > a; a++) c[a].validate()
                };
            return {
                validate: f
            }
        };
    a.formlogic = function(a) {
        var b = new e(a);
        b.validate()
    }, a.formlogic.field = function(a) {
        return new b(a)
    }
}(jQuery),
function(a) {
    var b, c, d = 1,
        e = a(".actions li.previous"),
        f = a(".actions li.next"),
        g = a(".actions .previous > a"),
        h = a(".actions .next > a"),
        i = a(".actions .numberText > label"),
        j = a("div.submit"),
        k = a(".stepBar .progress-bar"),
        l = k.find("label"),
        m = progressDefaultText = l.text(),
        n = function(a) {
            return a.replace("{page}", d).replace("{total}", b)
        },
        o = function(a) {
            d > a ? p(a) : q(a)
        },
        p = function(a) {
            for (var b = a; b > 0; b--) {
                var c = v(b);
                if (!c.hidden) return r(b)
            }
        },
        q = function(a) {
            for (var c = a; b >= c; c++) {
                var d = v(c);
                if (!d.hidden) return r(c)
            }
        },
        r = function(c) {
            if (!(1 > c || c > b)) {
                d = c;
                var e = v(d);
                m = "" == e.progressText ? progressDefaultText : e.progressText, a(".steps li").removeClass("current"), e.$e.addClass("current"), g.text(n(e.labelPrevious)), h.text(n(e.labelNext)), i.text(n(e.labelNumberText)), a("section.page").removeClass("current").hide(), a("section.page:eq(" + (d - 1) + ")").addClass("current").show("slow"), s(), t()
            }
        },
        s = function() {
            switch (!0) {
                case 1 == d:
                    e.hide(), f.show(), j.hide();
                    break;
                case d == b:
                    e.show(), f.hide(), j.show();
                    break;
                default:
                    e.show(), f.show(), j.hide()
            }
        },
        t = function() {
            var a = (d - 1) / b * 100 + "%",
                c = k.find("label"),
                e = m.replace("{percent}", a);
            c.text(e), k.css("width", a).attr("aria-valuenow", a)
        },
        u = function(a) {
            return a.charAt(0).toUpperCase() + a.slice(1)
        },
        v = function(b) {
            var c = {
                    step: 1,
                    fid: "",
                    hidden: !1,
                    labelPrevious: "Previous",
                    labelNext: "Next",
                    progressText: "",
                    labelNumberText: "",
                    disabled: !1
                },
                d = a('li[data-page-step="' + b + '"]');
            if (!d.length) return c;
            for (var e in c) {
                var f = d.data("page" + u(e));
                c[e] = f ? f : ""
            }
            return c.$e = d, c
        },
        w = function() {
            o(d - 1)
        },
        x = function() {
            var b = c.formId;
            return b ? a(b).valid() : !0
        },
        y = function() {
            x() && o(d + 1)
        },
        z = function() {
            0 != a(".steps").length && (b = a(".steps > li").length, o(1), g.click(function(a) {
                return a.preventDefault(), w(), !1
            }), h.click(function(a) {
                return a.preventDefault(), y(), !1
            }))
        },
        A = function() {
            function b(b, c) {
                if (c.hasClass("page")) {
                    var d = c.attr("id"),
                        e = a('li[data-page-fid="' + d + '"'),
                        f = v(e.data("pageStep"));
                    switch (b) {
                        case "logic:show":
                            e.data("pageHidden", !1).attr("data-page-hidden", !1), e.show("slow");
                            break;
                        case "logic:hide":
                            e.data("pageHidden", !0).attr("data-page-hidden", !0), e.hide("slow");
                            break;
                        case "logic:jumpTo":
                            x() && (e.show("slow"), o(f.step));
                            break;
                        case "logic:enable":
                            break;
                        case "logic:disable":
                    }
                }
            }

            function d(c, d) {
                var e = d["public"];
                e.$field.each(function() {
                    var d = a(this);
                    b(c.type, d)
                })
            }
            a(document).on("JF.ready", function(a, b) {
                c = b, z()
            }), a(document).on("logic:show logic:hide logic:jumpTo logic:enable logic:disable", d)
        };
    a.fn.formSteps = function(b) {
        return a.fn.formSteps[b] ? a.fn.formSteps[b].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof b && b ? void a.error("Method " + b + " does not exist on jQuery.formSteps") : initialize.apply(this, arguments)
    }, a.fn.formSteps.init = A, a.fn.formSteps.getStep = v, a.fn.formSteps.gotoStep = o
}(jQuery), $("body").formSteps("init"),
    function(a) {
        function b(b, c) {
            if (b.length) {
                c || (c = window);
                var d = !1,
                    e = function() {
                        if (!d) {
                            d = !0;
                            var e = a(c).width();
                            b.each(function(b, c) {
                                var d, f = a(c),
                                    g = f[0];
                                return !g.complete || "undefined" != typeof g.naturalWidth && 0 == g.naturalWidth ? !1 : (f.data("origwidth") || f.data("origwidth", g.naturalWidth), d = f.data("origwidth") > e - 40 ? "100%" : f.data("origwidth") + "px", void f.css("width", d))
                            }), d = !1
                        }
                    };
                e(), a(window).resize(e)
            }
        }
        a.setResponsiveToImages = b
    }(jQuery),
    function(a) {
        function b(a, b, c, d) {
            d = parseFloat(d), d = isNaN(d) ? 0 : d, a instanceof Date && b instanceof Date ? (a = a.getTime(), b = b.getTime(), d = 864e5 * d) : (a = parseFloat(a), a = isNaN(a) ? 0 : a, b = parseFloat(b), b = isNaN(b) ? 0 : b);
            var e;
            switch (c) {
                case ">":
                    e = a > b + d;
                    break;
                case "<":
                    e = b + d > a;
                    break;
                case ">=":
                    e = a >= b + d;
                    break;
                case "<=":
                    e = b + d >= a;
                    break;
                case "!=":
                    e = a != b + d;
                    break;
                case "=":
                case "==":
                    e = a == b + d
            }
            return e
        }
        jQuery.validator.addMethod("compareTo", function(c, d) {
            var e = !0,
                f = a(d),
                g = f.data("rule-compareto"),
                h = f.data("rule-compareto-method"),
                i = f.data("rule-compareto-diff"),
                j = f.data("rule-compareto-type"),
                k = f.val(),
                l = a(g).val();
            return "" == l ? !0 : ("date" == j && (k = new Date(k), l = new Date(l)), e = b(k, l, h, i))
        }, "Failed to compare two fields")
    }(jQuery),
    function() {
        function a() {
            var a = window.location.href.indexOf("?");
            if (-1 !== a) {
                var b = window.location.href.slice(a + 1),
                    c = deparam(b);
                $.each(c, function(a, b) {
                    try {
                        $("#" + a + ',[name="' + a + '"],[name="' + a + '[]"]').each(function() {
                            var a = $(this),
                                c = a.val();
                            switch (!0) {
                                case a.is(":checkbox"):
                                case a.is(":radio"):
                                    if (c == b || -1 !== $.inArray(c, b)) {
                                        a.prop("checked", !0);
                                        try {
                                            a.iCheck("update")
                                        } catch (d) {}
                                    }
                                    break;
                                case a.is("select"):
                                    a.select2 ? a.select2("val", b) : a.val(b);
                                    break;
                                default:
                                    a.val(b)
                            }
                        })
                    } catch (c) {}
                })
            }
        }

        function b(a) {
            var b = $(a),
                c = b.attr("action"),
                d = -1 == c.indexOf("?") ? "?" : "&",
                e = c + d + "method=csrfToken";
            $.get(e, function(a) {
                try {
                    a = $.parseJSON(a)
                } catch (c) {
                    return
                }
                "undefined" != typeof a.csrf_token && $("<input>").attr({
                    type: "hidden",
                    id: "csrf_token",
                    name: "csrf_token",
                    value: a.csrf_token
                }).appendTo(b)
            })
        }

        function d() {
            var a = function() {
                var a = $(this),
                    b = a.closest("div.form-group"),
                    c = b.find("input.jf-has-box");
                c.each(function() {
                    var b = $(this).attr("id") + "_box",
                        c = $("#" + b);
                    $(this).is(":checked") && c.show(), a.attr("id") + "_box" == b && c.focus()
                })
            };
            $(".jf-form").on({
                click: a,
                handleOptionBox: a
            }, ".jf-has-box"), $(".jf-option-box").blur(function() {
                var a = String($(this).attr("id")).replace("_box", "");
                "" == $.trim($(this).val()) && $("#" + a).attr("checked", !1), $("#" + a).val($(this).val()).trigger("change")
            })
        }

        function f(a) {
            var b = function(b) {
                    var c = $(b),
                        d = c.is("input.form-control") || c.is("select.form-control") || c.is("textarea.form-control"),
                        e = c.closest("div.form-group").find(".file-input-new");
                    c.closest("div.form-group").addClass("bg-info has-error" + (d ? " has-feedback" : "")), c.is(":visible") && d && !c.data("glyphicon") && ($('<span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>').insertAfter(c), c.data("glyphicon", !0), setTimeout(function() {
                        var a, b = c.height(),
                            d = c.width();
                        switch (!0) {
                            case e.length >= 1:
                                a = c.closest("div.form-group").find("div.file-caption").offset();
                                break;
                            case c.hasClass("select2-hidden-accessible"):
                                var f = c.closest("div.form-group").find(".select2-container");
                                b = f.height() - 2, d = f.width() - 50, a = f.offset(), console.log("select2", a, f);
                                break;
                            default:
                                a = c.offset()
                        }
                        var g = c.closest("div.form-group").find("span.glyphicon-warning-sign"),
                            h = {
                                top: a.top + (b - g.height()) / 2 + 4,
                                left: a.left + d + 10
                            };
                        g.offset(h)
                    }, 50)), g($.Event("invalid-form"), $(a).data("validator"))
                },
                c = function(b) {
                    $(b).data("glyphicon", !1), $(b).closest("div.form-group").removeClass("bg-info has-error has-feedback").find("span.glyphicon,p.validation-error").remove(), g($.Event("invalid-form"), $(a).data("validator"))
                };
            $("input[type=file].form-control").on("fileloaded", function() {
                c(this, "", "")
            });
            var d = function(a, b) {
                    var c = $(b).closest("div.form-group").find("p.description");
                    c.length > 0 ? a.insertBefore(c) : a.appendTo($(b).closest("div.form-group"))
                },
                f = function() {
                    var a, b = $("#g-recaptcha").data("size"),
                        c = function() {
                            var a = function() {
                                    (!b || grecaptcha) && $("#g-recaptcha-response").length && ($("#g-recaptcha-response").rules("add", {
                                        required: !0
                                    }), b && grecaptcha.execute(), clearInterval(c))
                                },
                                c = setInterval(a, 800)
                        },
                        d = function() {
                            $("#g-recaptcha-response").length && ($("#g-recaptcha-response").valid(), a = !0)
                        };
                    return {
                        init: c,
                        checkRequired: function() {
                            a || setInterval(d, 800)
                        }
                    }
                }(),
                g = function(a, b) {
                    var c = b.numberOfInvalids();
                    c && ($("p.error").show(), f.checkRequired()), c = b.numberOfInvalids(), c || $("p.error").hasClass("server-error") || $("p.error").hide()
                },
                h = {},
                i = function(a) {
                    return $.each(h, function(b, c) {
                        var d = new RegExp("{" + b + "}", "gi");
                        a = a.replace(d, c)
                    }), a
                },
                j = function(a) {
                    var b = $(".jf-thankyou");
                    if (b.length) {
                        var c = $.trim(b.data("redirect"));
                        c = decodeURIComponent(c), a && a.serverRedirect && (c = a.serverRedirect);
                        var d = i(b.html());
                        b.html(d);
                        var e = function() {
                            if (parent) {
                                var a = ($("body > *:visible").height(), $(window.parent.document).find('iframe[src*="' + location.pathname + '"]'));
                                a.length > 0 && $(window.parent.document).find("html, body").animate({
                                    scrollTop: a.offset().top
                                }, 500)
                            }
                        };
                        if ("" === c) return b.show("slow"), void setTimeout(e, 500);
                        var f = parseInt(b.data("seconds"));
                        a && a["serverRedirect.setTimeout"] && (f = a["serverRedirect.setTimeout"]), f > 0 ? (b.show("slow"), setTimeout(e, 500)) : f = 0, setTimeout(function() {
                            c = i(c);
                            try {
                                parent && (parent.location.href = c)
                            } catch (a) {
                                location.href = c
                            }
                        }, 1e3 * f)
                    }
                },
                k = function() {
                    var a, b = $(".submit > button"),
                        c = $(".submit div.progress");
                    a = {
                        width: b.outerWidth(),
                        height: b.outerHeight()
                    };
                    var d = function() {
                            c.css(a).show(), b.prop("disabled", !0)
                        },
                        e = function() {
                            c.hide(), b.prop("disabled", !1)
                        };
                    return {
                        showProgressBar: d,
                        hideProgressBar: e
                    }
                },
                l = function(a) {
                    if (null === location.href.match(/^https*/) && null === $(a).attr("action").match(/^https*/)) return $("h4.local-submit").length || $("<h4 style='padding:16px;' class='bg-info local-submit'>Form submit does not work on local computer.<br>Please test it on your web server!</h4>").appendTo($(".jf-form")), !1;
                    var b = $(".submit p.error");
                    b.data("origMsg") || b.data("origMsg", b.html());
                    var c = [];
                    $(a).find("div.required").not(".jf-hide,.jf-disabled").each(function() {
                        c.push($(this).data("fid"))
                    }), $("#serverValidationFields").val(c.join(",")), b.removeClass("server-error"), $btn = new k, $btn.showProgressBar();
                    var d = function() {
                        var c = $(a).ajaxSubmit(),
                            d = c.data("jqxhr");
                        d.done(function(a) {
                            var c = !1;
                            try {
                                data = $.parseJSON(a)
                            } catch (d) {
                                c = !0, data = {
                                    validated: !1
                                }
                            }
                            data && data.validated === !0 ? ($(".jf-form").hide(), h = data.fieldValues, j(h)) : (c && b.text(a), b.addClass("server-error").show("slow"), $btn.hideProgressBar(), setTimeout(function() {
                                b.html(b.data("origMsg")), b.hide()
                            }, 5e3))
                        })
                    };
                    setTimeout(d(), 3e3)
                };
            $.validator.methods.required = function(a, b, c) {
                if (!this.depend(c, b)) return "dependency-mismatch";
                if ("select" === b.nodeName.toLowerCase()) {
                    var d = $(b).val();
                    return d && d.length > 0 && "" != d
                }
                return this.checkable(b) ? this.getLength(a, b) > 0 : $.trim(a).length > 0
            }, $.validator.methods.equalto = $.validator.methods.equalTo;
            var m = function() {
                    var a = $(this);
                    return a.hasClass("g-recaptcha-response") && !$("#g-recaptcha").is(":hidden") ? !1 : (yes = a.is(":hidden") || a.is(":input.tmp-disabled"), yes)
                },
                n = 0 === String($(a).data("licensekey")).toUpperCase().indexOf("JF-");
            n ? $(".jf-copyright").remove() : (e(), setInterval(e, 1e4)), $(a).validate({
                errorClass: "validation-error help-block bg-warning",
                errorElement: "p",
                ignore: m,
                highlight: b,
                unhighlight: c,
                invalidHandler: g,
                submitHandler: l,
                errorPlacement: d
            }), $(".g-recaptcha").length && f.init()
        }

        function g(a) {
            $.jMaskGlobals.watchDataMask = !0, $(a).each(function(a, b) {
                var c, d = {
                        autoclose: !0
                    },
                    e = $(b);
                $.each(["format", "weekStart", "startDate", "endDate", "startView", "minViewMode", "todayBtn", "clearBtn", "language", "orientation", "multidate", "multidateSeparator", "daysOfWeekDisabled", "calendarWeeks", "autoclose", "todayHighlight", "datesDisabled", "toggleActive", "defaultViewDate"], function(a, b) {
                    c = e.data("datepicker-" + b.toLowerCase()), c && (d[b] = "daysOfWeekDisabled" == b ? String(c) : c)
                }), e.datepicker(d).on("changeDate", function(a) {
                    $(a.target).valid()
                }), e.next(".input-group-addon.right").click(function() {
                    e.datepicker("show")
                })
            })
        }

        function h() {
            $("input[type=file].form-control").each(function(a, b) {
                var c = {
                        showUpload: !1,
                        autoReplace: !1,
                        overwriteInitial: !1,
                        initialPreviewShowDelete: !0,
                        uploadAsync: !1
                    },
                    d = $(b),
                    e = "showPreview,showRemove,showUpload,showZoom".split(","),
                    f = d.data("allowedfileextensions"),
                    g = d.data("multiple"),
                    h = d.data("browselabel"),
                    i = parseInt(d.data("maxfilecount")),
                    j = d.data("maxfilesize");
                i > 0 && (c.maxFileCount = i), g || (c.maxFileCount = 1), h && (c.browseLabel = h), f && (c.allowedFileExtensions = String(f).replace(/\s+/g, "").split(",")), j && (c.maxFileSize = parseFloat(String(j))), "undefined" != typeof fileinputLanguage && (c.language = fileinputLanguage);
                for (var a = 0, k = e.length; k > a; a++) {
                    var l = e[a],
                        m = /(false|0|no)/i,
                        n = m.test(String(d.data(l.toLowerCase())));
                    n && (c[l] = !1)
                }
                d.fileinput(c)
            }), setTimeout(function() {
                $("div.btn-file").removeClass("btn-primary").addClass("btn-default")
            }, 350)
        }
        var i = {};
        i.init = function(e) {
            c(), h(), g(".datepicker"), d(), f(e), b(e), a(), $(document).trigger("JF.ready", {
                formId: e
            }), $.setResponsiveToImages($(e).find("img"))
        }, $.formlogic && $.formlogic.field && (i.field = $.formlogic.field), window.JF = i
    }(),
    function() {
        function a(a, b) {
            for (var c, d = [], e = !1, f = !1, a = String(a).toLowerCase(), g = 0, h = b.length; h > g; g++) {
                c = b[g], ("undefined" == typeof c.value || "" == $.trim(c.value) || "null" == $.trim(c.value) || "undefined" == $.trim(c.value)) && (c.value = c.label);
                var i = "#depend" == c.label;
                if (i && String(c.value).toLowerCase() == a) e = !0;
                else {
                    if (i && e && String(c.value).toLowerCase() != a) {
                        f = !0;
                        break
                    }
                    e && d.push(c)
                }
            }
            return d
        }

        function b(b) {
            var c = d[b];
            if (c) {
                var e = c.options,
                    b = "#" + b,
                    f = "#" + c.dependOn;
                $(f).change(function() {
                    var c = $(this).val(),
                        d = a(c, e),
                        f = [];
                    $(b).empty();
                    for (var g = 0, h = d.length; h > g; g++) {
                        var i = d[g],
                            j = $.trim(i.value),
                            k = 'value="' + j.replace('"', "&quot;").replace("#empty", "").replace("#novalue", "") + '"';
                        f.push("<option " + k + ">" + i.label + "</option>")
                    }
                    $(b).append(f.join()), setTimeout(function() {
                        try {
                            $(b).select2("val", "")
                        } catch (a) {}
                    }, 300)
                })
            }
        }

        function c(a, c) {
            d = c;
            for (var e in d) d.hasOwnProperty(e) && b(e)
        }
        var d;
        $(document).on("dependent:setup", c)
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
    }();