(function ($) {

    $.fn.passwordRulesValidator = function (aOptions) {
    

        // Define default's parameters
        var aDefauts =
                {
                    'rules' : {
                        'length' : {
                            'regex': '.{8,}',
                            'name': 'length',
                            'message': '8 characters',
                            'enable': true
                        },
                        'lowercase' :{
                            'regex': '[a-z]{1,}',
                            'name': 'lowercase',
                            'message': '1 lowercase',
                            'enable': true
                        },
                        'uppercase' : {
                            'regex': '[A-Z]{1,}',
                            'name': 'uppercase',
                            'message': '1 uppercase',
                            'enable': true
                        },
                        'number' : {
                            'regex': '[0-9]{1,}',
                            'name': 'number',
                            'message': '1 digit',
                            'enable': true
                        },
                        'specialChar' : {
                            'regex': '[^a-zA-Z0-9]{1,}',
                            'name': 'special-char',
                            'message': '1 special character',
                            'enable': true
                        }
                    },
                    'msgRules': 'Your password must contain :',
                    'container': undefined,
                    'containerClass': null,
                    'containerId': 'checkRulesList',
                    'okClass': null,
                    'koClass': null,
                    'onLoad': undefined
        };

        /**
         * @param {object} oRegex
         * @param {string} sVal
         * @param {string} sName
         * @param {string} sIdContainer
         */
        function validateRule(oRegex, sVal, sName, sIdContainer)
        {
            if (oRegex.test(sVal)) {
                $('#' + sIdContainer + ' li.' + sName).removeClass('ko ' + aParameters.koClass).addClass('ok ' + aParameters.okClass);
            } else {
                $('#' + sIdContainer + ' li.' + sName).removeClass('ok ' +aParameters.okClass).addClass('ko ' +aParameters.koClass);
            }
        }
        
        /**
         * @param {array} aParemeters
         * @param {string} sVal
         * @param {string} sIdContainer
         */
        function checkRules(aParemeters, sVal, sIdContainer)
        {
            $.each(aParameters.rules, function(iKey, aRule) {
                if(aRule.enable) {
                    validateRule(new RegExp(aRule.regex, 'g'), sVal, aRule.name, sIdContainer);
                }
            });
            
        }

        var aParameters = $.extend(true, aDefauts, aOptions);
        
        return this.each(function () {
            
            // Execute onLoad fonction
            if ($.isFunction(aParameters.onLoad)) {
                aParameters.onLoad();
            }

            // Build rules check list
            oRulesBuilder = '<span class="rules">' + aParameters.msgRules + '</span>';
            oRulesBuilder += '<ul class="rules">';
            
            // Build lists
            $.each(aParameters.rules, function(iKey, aRule) {
                if(aRule.enable) {
                    oRulesBuilder += '<li class="ko ' + aParameters.koClass + ' '+ aRule.name +'">' + aRule.message + '</li>';
                }
            });
            
            oRulesBuilder += '</ul>';
            
            // Create or populate container
            if (typeof (aParameters.container) === 'undefined') {
                $(this).after('<div class="rules-list ' + aParameters.containerClass + '" id="' + aParameters.containerId + '"></div>');
                $(oRulesBuilder).appendTo('#' + aParameters.containerId);
            } else {
                aParameters.container.addClass('rules-list');
                $(oRulesBuilder).appendTo(aParameters.container);
            }

            var sIdContainer = typeof (aParameters.container) === 'undefined' ? aParameters.containerId : aParameters.container.attr('id');
            
            // Execute checkRules on load
            checkRules(aParameters, $(this).val(), sIdContainer);
            
            // Execute checkRules fonction
            $(this).keyup(function () {
                checkRules(aParameters, $(this).val(), sIdContainer);
            });

            $(this).on('paste', function () {
                checkRules(aParameters, $(this).val(), sIdContainer);
            });

            $(this).change(function () {
                checkRules(aParameters, $(this).val(), sIdContainer);
            });
        });
    };
})(jQuery);


