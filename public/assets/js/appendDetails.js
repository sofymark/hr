function addDetail(e) {
    e.preventDefault();
    var table = $('table.' + $(this).data('target')),
        newRecord = $(this).parent().siblings('.modal-body'),
        form = newRecord.children('form'),
        modalWindow = $(this).closest('.modal'),
        hiddenInput = $(table).find('input:hidden:first'),
        tableConfig = $(table).find('input:hidden[class=tableConfig]');
    hideAlert(table);

    if(!form.valid()) {
        return false;
    }

    var record = buildObj(table, newRecord, hiddenInput);
    if (!record) {
        showAlert(table);
        return false;
    }
    appendTableRows(table, tableConfig, [record]);

    $(modalWindow).find('input:text, select').val('');

    educationListener();
    languageListener();
    
    modalWindow.modal('toggle');
}

function buildObj(table, newRecord, hiddenInput) {

    var obj = {}, stop = false;
    newRecord.children().find('input,select').each(function () {
        var forAttr = $(this).attr('for');
        if (!forAttr) return;
        var val = $(this).val();
        var vattr = '';

        switch (true) {
            case $(this).is("select"):
                if (!val || val == '') vattr = '';
                else vattr = $(this).find('option:selected').text();
                obj[forAttr] = val;
                obj['vAttr_' + forAttr] = vattr;
                break;
            default:
                if ($(this).attr('type') === 'radio') {
                    val = $('input[for=' + forAttr + ']:checked').val();
                    vattr = $('input[for=' + forAttr + ']:checked').closest('label').text().trim();
                }

                if ($(this).parent().hasClass('date'))
                {
                    var d = val.split("/");
                    if (d.length > 0) val = d[2] + '-' + d[1] + '-' + d[0];
                }

                obj[forAttr] = val;
                obj['vAttr_' + forAttr] = vattr;
                break;
        }
    });
    var oldValue = hiddenInput.val(), newValue = [];
    if (oldValue) newValue = JSON.parse(oldValue);
    newValue.push(obj);
    if (hiddenInput) hiddenInput.val(JSON.stringify(newValue));
    return obj;
}

function appendTableRows(table, tableConfig, records) {
    var tableConfigObj = JSON.parse(tableConfig.val());
    var text = '';
    for (var i in records) {
        var record = records[i];
        text += '<tr class="list-data">';
        for (var j in tableConfigObj) {
            var column = tableConfigObj[j]['column'];
            if (typeof column !== 'string') {
                text += '<td>';
                for (var k in column) {
                    var subColumn = column[k]['column'];
                    text = [text, record[subColumn]].join(' ');
                }
                text += '</td>';
            } else {
                var value = record[column];

                if(column.search(/date/i) != -1)
                {
                    var d = value.split("-");
                    if (d.length > 0) value = d[2] + '/' + d[1] + '/' + d[0];
                }

                text += ['<td>', value, '</td>'].join('');
            }
        }
        text += '<td class="text-right"><button class="btn btn-danger btn-remove" type="button"><span class="glyphicon glyphicon-minus"></span>ΑΦΑΙΡΕΣΗ</button></td>';
        text += '</tr>';
    }
    $(text).appendTo(table.find('tbody'));
}

function removeDetail(e) {
    var table = $(this).closest(constants.getElemClassName('list', true)),
        hiddenInput = $(table).find('input:hidden:first'),
        row = $(this).parents(constants.getElemClassName('record')),
        index = table.find('.btn-remove').index(this);

    if (hiddenInput) {
        var val = hiddenInput.val();
        if (val) val = JSON.parse(val);
        val.splice(index, 1); // remove
        console.log(val);
        hiddenInput.val(JSON.stringify(val));// update
    }
    if (row) row.remove();
    e.preventDefault();
    return false;
}

function initDetails() {
    $(document).on('click', constants.getElemClassName('add', true), addDetail)
               .on('click', constants.getElemClassName('remove', true), removeDetail);
}
