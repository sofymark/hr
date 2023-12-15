var constants = (function () {
    var elem = {
        "list": "list",
        "record": "tr",
        "firstRecord": "tr:first",
        'add': 'btn-add',
        'remove': 'btn-remove',
        'success': 'btn-success',
        'danger': 'btn-danger'
    };
    var sections = {
        '0': ['employeePersonalInfo', 'protectedMember'],
        '1': ['employeePersonalInfo'],
        '2': ['education'],
        '3': ['language'],
        '4': ['certification'],
        '5': ['experience']
    };

    return {
        getElemClassName: function (type, withDot) {
            return (withDot) ? ['.', elem[type]].join('') : elem[type];
        },
        getEntitiesBySection: function (sectionNo) {
            return sections[sectionNo];
        }
    };
})();
