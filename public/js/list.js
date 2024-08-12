const this_fragment = document.documentURI.match(/#.*$/).toString();
const ip_form = document.forms.namedItem('ip-form');

document.addEventListener('load', function(e) {
    ip_form.action = `/list/${this_fragment}/add-ip`;
    
});