NioApp=function(t,o){"use strict";var e=o(".toastr-top-center"),s=o(".toastr-top-right"),n=o(".toastr-top-left"),i=o(".toastr-top-full"),a=o(".toastr-bottom-center"),r=o(".toastr-bottom-right"),c=o(".toastr-bottom-left"),u=o(".toastr-bottom-full"),l=o(".toastr-info"),p=o(".toastr-success"),f=o(".toastr-warning"),h=o(".toastr-error");return t.Toastr={},t.Toastr.ToastrJs=function(){e.exists()&&e.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-top-center",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info("This is a note for Info message on Top Center"),t.preventDefault()})}),s.exists()&&s.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-top-right",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info("This is a note for Info message on Top Right"),t.preventDefault()})}),n.exists()&&n.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-top-left",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info("This is a note for Info message on Top Left"),t.preventDefault()})}),i.exists()&&i.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-top-full-width",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info("This is a note for Info message on Top Full"),t.preventDefault()})}),a.exists()&&a.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-bottom-center",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info("This is a note for Info message on Bottom Center"),t.preventDefault()})}),r.exists()&&r.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-bottom-right",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info("This is a note for Info message on Bottom Right"),t.preventDefault()})}),c.exists()&&c.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-bottom-left",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info("This is a note for Info message on Bottom Left"),t.preventDefault()})}),u.exists()&&u.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-bottom-full-width",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info("This is a note for Info message on Bottom Full"),t.preventDefault()})}),l.exists()&&l.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-bottom-center",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.info('<em class="ti ti-filter toast-message-icon"></em> This is a note for Info message'),t.preventDefault()})}),p.exists()&&p.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-bottom-center",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.success('<em class="ti ti-check toast-message-icon"></em> This is a note for Success message'),t.preventDefault()})}),f.exists()&&f.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-bottom-center",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.warning('<em class="ti ti-alert toast-message-icon"></em> This is a note for Warning message'),t.preventDefault()})}),h.exists()&&h.each(function(){o(this).on("click",function(t){toastr.clear(),toastr.options={closeButton:!0,newestOnTop:!1,preventDuplicates:!0,positionClass:"toast-bottom-center",showDuration:"1000",hideDuration:"10000",timeOut:"2000",extendedTimeOut:"1000"},toastr.error('<em class="ti ti-na toast-message-icon"></em> This is a note for Error message'),t.preventDefault()})})},t.components.docReady.push(t.Toastr.ToastrJs),t}(NioApp,jQuery,window);