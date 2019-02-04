function makeDeleteForm(url)
{
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    var delInput = document.createElement('input');
    delInput.type = 'hidden';
    delInput.name = '_method';
    delInput.value = 'DELETE';
    form.appendChild(delInput);
    var csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = jQuery('meta[name="csrf-token"]').attr('content');
    form.appendChild(csrf);
    document.body.appendChild(form);
    return form;
}

function debounce(fn, delay = 300) {
    var timeoutID = null;

    return function () {
        clearTimeout(timeoutID);

        var args = arguments;
        var that = this;

        timeoutID = setTimeout(function () {
            fn.apply(that, args);
        }, delay);
    }
};
