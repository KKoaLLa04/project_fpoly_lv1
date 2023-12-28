let permissionObj = document.querySelector('.permission_obj');

if (permissionObj !== null) {

    let rolePermission = permissionObj.querySelectorAll('tr')

    let allowRole = [
        'Thêm',
        'Sửa',
        'Xóa',
        'Nhân Bản',
    ]
    if (rolePermission !== null) {
        rolePermission.forEach(function (item) {
            let checkboxRole = item.querySelectorAll('input[type="checkbox"]');

            if (checkboxRole !== null) {
                checkboxRole.forEach(function (checkbox) {
                    checkbox.addEventListener('click', function (e) {
                        let checkboxValue = this.value;
                        if (checkboxValue !== null && allowRole.includes(checkboxValue)) {
                            let viewRole = item.querySelector('input[value="Xem"]');

                            if (viewRole !== null) {
                                viewRole.checked = true;
                            }
                        }
                    })
                })
            }
        })
    }
}

// xu ly ckeditor
function openCkEditor() {
    let classTextarea = document.querySelectorAll('.editor');
    if (classTextarea !== null) {
        classTextarea.forEach((item, index) => {
            item.id = 'editor_' + (index + 1);
            CKEDITOR.replace(item.id);
        })
    }
}
openCkEditor();