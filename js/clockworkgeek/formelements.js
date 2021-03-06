/*
 * The MIT License (MIT)
 * 
 * Copyright (c) 2015 Daniel Deady
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

self.Validation && !Validation.methods['validate-color'] && Validation.add('validate-color', 'Please enter a CSS formatted color value.', function(v) {
    return /^#[0-9a-zA-Z]{6}$/.test(v);
});

/*
 * Check this input after media browser windows close and maybe parse a directive
 */
function watchMediaUrl(id, thumbnailUrl) {
    Windows.addObserver({ onDestroy: function(name, event) {
        if (event.element && event.element.id == 'browser_window') {
            (function() {
                var input = $(id),
                    value = $F(input),
                directive = /\/___directive\/([-,\w]+)\//.exec(value);
                if (directive && directive.length) {
                    directive = directive[1].replace(/-/g,'+').replace(/_/g,'/').replace(/,/g,'=');
                    value = atob(directive);
                    input.setValue(value);
                }
                var filename = /{{media url="wysiwyg\/([^"]+)"}}/.exec(value),
                  previewurl = thumbnailUrl && filename && (thumbnailUrl+'file/'+btoa(filename[1]).replace(/\+/g,'-').replace(/\//g,'_').replace(/=/g,','));
                $(id+'_preview').innerHTML = previewurl ? '<img src="'+previewurl+'/" alt="'+filename[1]+'"/>' : '';
            }).defer();
        }
    }});
}

function clearMediaUrl(id) {
    Form.Element.setValue(id, '');
    $(id+'_preview').innerHTML = '';
}

/**
 * The following is copyright (c) 2011..2012 David Chambers <dc@hashify.me>
 * @see https://github.com/davidchambers/Base64.js
 */
!function(){function t(t){this.message=t}var r="undefined"!=typeof exports?exports:this,e="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";t.prototype=new Error,t.prototype.name="InvalidCharacterError",r.btoa||(r.btoa=function(r){for(var o,n,a=String(r),i=0,c=e,d="";a.charAt(0|i)||(c="=",i%1);d+=c.charAt(63&o>>8-i%1*8)){if(n=a.charCodeAt(i+=.75),n>255)throw new t("'btoa' failed: The string to be encoded contains characters outside of the Latin1 range.");o=o<<8|n}return d}),r.atob||(r.atob=function(r){var o=String(r).replace(/=+$/,"");if(o.length%4==1)throw new t("'atob' failed: The string to be decoded is not correctly encoded.");for(var n,a,i=0,c=0,d="";a=o.charAt(c++);~a&&(n=i%4?64*n+a:a,i++%4)?d+=String.fromCharCode(255&n>>(-2*i&6)):0)a=e.indexOf(a);return d})}();
