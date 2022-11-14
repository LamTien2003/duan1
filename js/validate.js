const listForm = document.querySelectorAll('.form-group')
const btn = document.querySelector('form:not(.search-input)')

// Chưa click btn thì không hiện lỗi
let isClick = false;

validate()
btn.addEventListener('submit',(e)=> {
    
    isClick = true
    let status = validate()
    if(status) {
        
    }else {
        // PREVENT DE FIX LOI GUI BIEU MAU CUA PHP, NGAN CHAN VIEC FORM GUI SUBMIT KHI JS CHUA VALIDATE
        alert("Vui lòng nhập đúng các thông tin")
        e.preventDefault()
    }
})

function validate() {
    let isFormSubmit = true;
    listForm.forEach(form => {
        let select = form.querySelector('select')
        if(select) {
            isClick ? (check(form) ? undefined : isFormSubmit = false ) : undefined
            select.addEventListener('change',() => {
                check(form)
            })
        }
        let inputs = form.querySelectorAll('input')
        inputs.forEach(input => {
            switch (input.name) {
                
                case "userName" : {
                    isClick? (check(form,0,50) ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {   
                        check(form,0,50)
                    })
                    break;
                }
                case "password" : {
                    isClick? (check(form,0,50) ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {   
                        check(form,0,50)
                    })
                    break;
                }
                
                default: {
                    isClick? (check(form) ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {
                        check(form)
                    })
                }
                break;
            }
        })
    })
    return isFormSubmit
}

function check(form,min = 0,max = 100,regex = "",error = "Không được để trống") {
    const inputs = form.querySelectorAll('input')
    const select = form.querySelector('select')
    let isChecked = false
    const mess = form.querySelector('.form-message')
    // Neu la` form co select thi` kiem tra value, co thi return true
    select ? (select.value || select.value == 0 ? isChecked = true: undefined): undefined
    inputs.forEach(input => {
        switch(input.type) {
            case "file": {
                if(input.value) {
                    isChecked = true
                }
                break;
            }
            case "radio": {
                if(input.checked) {
                    isChecked = true
                }
                break;
            }
            case "checkbox": {
                if(input.checked) {
                    isChecked = true
                }
                break;
            }
            default: {
                switch(input.name) {
                    
                    case "userName" : {
                        if(input.value && input.value.match(regex) && input.value.length <= max && input.value.length >= min) {       
                            isChecked = true
                        }else {
                            input.value.length == 0 ? undefined : error = `Tên đăng nhập chỉ có thể nhập dưới ${max} kí tự`
                        }
                        break;
                    }
                    case "password" : {
                        if(input.value && input.value.match(regex) && input.value.length <= max && input.value.length >= min) {       
                            isChecked = true
                        }else {
                            input.value.length == 0 ? undefined : error = `Mật khẩu chỉ có thể nhập dưới ${max} kí tự`
                        }
                        break;
                    }
                    
                    default: {
                        if(input.value && input.value.match(regex) && input.value.length <= max && input.value.length >= min) {       
                            isChecked = true
                        }else {
                            input.value.length == 0 ? undefined : error = `Tên đăng nhập chỉ có thể nhập dưới ${max} kí tự`
                        } break;
                    }
                }
                
                break;
            }
        }
    })
    if(!isChecked) {
        mess.innerHTML = error
        form.querySelector('input') ? form.querySelector('input').style.backgroundColor = 'gold' : undefined
    }else {
        mess.innerHTML = ''
        form.querySelector('input') ? form.querySelector('input').style.backgroundColor = 'white' : undefined
    }
    return isChecked
}