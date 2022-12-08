const listForm = document.querySelectorAll('.form-group')
const btn = document.querySelector('form:not(.search-btn)')
console.log(btn);
// Chưa click btn thì không hiện lỗi
let isClick = false;

validate()
btn.addEventListener('submit',(e)=> {
    console.log("submit nè")
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
                case "price": {
                    // NEU CHECK RETURN FALSE THI` GAN' ISFORM = FALSE
                    isClick ? (check(form, 0, Infinity, /[0-9]/, "Đơn giá phải là kiểu số và lớn hơn 0") ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {
                        check(form, 0, Infinity, /[0-9]/, "Đơn giá phải là kiểu số và lớn hơn 0")
                    })
                    break;
                }
                case "tonkho": {
                    // NEU CHECK RETURN FALSE THI` GAN' ISFORM = FALSE
                    isClick ? (check(form, 0, Infinity, /[0-9]/, "Số lượng tồn kho phải là kiểu số và lớn hơn 0") ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {
                        check(form, 0, Infinity, /[0-9]/, "Số lượng tồn kho phải là kiểu số và lớn hơn 0")
                    })
                    break;
                }
                case "daban": {
                    // NEU CHECK RETURN FALSE THI` GAN' ISFORM = FALSE
                    isClick ? (check(form, 0, Infinity, /[0-9]/, "Số lượng đã bán phải là kiểu số và lớn hơn 0") ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {
                        check(form, 0, Infinity, /[0-9]/, "Số lượng đã bán phải là kiểu số và lớn hơn 0")
                    })
                    break;
                }
                case "mssv" : {
                        // NEU CHECK RETURN FALSE THI` GAN' ISFORM = FALSE
                    isClick ? (check(form,0,7,/(ps|PS)[0-9]{5}/,"MSSV phải có đúng 7 kí tự") ? undefined : isFormSubmit = false ) : undefined
                    input.addEventListener('input', () => {   
                        check(form,0,7,/(ps|PS)[0-9]{5}/,"MSSV phải có đúng 7 kí tự")
                    })
                    break;
                }
                case "email" : {
                    isClick ? (check(form,0,100,/^[^\s@]+@[^\s@]+\.[^\s@]+$/,"Vui lòng nhập đúng Email") ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {   
                        check(form,0,100,/^[^\s@]+@[^\s@]+\.[^\s@]+$/,"Vui lòng nhập đúng Email")
                    })
                    break;
                }
                case "fullname" : {
                    isClick? (check(form,0,30) ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {   
                        check(form,0,30)
                    })
                    break;
                }
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
                case "phone" : {
                    isClick ? (check(form,0,100,/(84|0[3|5|7|8|9])+([0-9]{8})\b/,"Vui lòng nhập đúng Số điện thoại") ? undefined : isFormSubmit = false) : undefined
                    input.addEventListener('input', () => {   
                        check(form,0,100,/(84|0[3|5|7|8|9])+([0-9]{8})\b/,"Vui lòng nhập đúng Số điện thoại")
                    })
                    break;
                }
                case "description" : break;
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
                    case "price": {
                        if (input.value && input.value.match(regex) && input.value.length <= max && input.value.length > min && input.value > 0) {
                            isChecked = true
                        }else {
                            input.value.length == 0 ? error = "Không được để trống" : undefined
                        }
                        break;
                    }
                    case "tonkho": {
                        if (input.value && input.value.match(regex) && input.value.length <= max && input.value.length > min && input.value > 0) {
                            isChecked = true
                        }else {
                            input.value.length == 0 ? error = "Không được để trống" : undefined
                        }
                        break;
                    }
                    case "daban": {
                        if (input.value && input.value.match(regex) && input.value.length <= max && input.value.length > min && input.value > 0) {
                            isChecked = true
                        }else {
                            input.value.length == 0 ? error = "Không được để trống" : undefined
                        }
                        break;
                    }
                    case "mssv" : {
                        if(input.value && input.value.match(regex) && input.value.length == max && input.value.length >= min ) {
                            isChecked = true
                        }else if (input.value && !input.value.match(regex) && input.value.length == max && input.value.length >= min) {
                            error = "Đã đủ 7 kí tự nhưng không đúng dịnh dạng"
                        }
                        else {
                            input.value.length == 0 ? error = "Không được để trống" : undefined
                        }
                        break;
                    }
                    case "email" : {
                        if(input.value && input.value.match(regex) && input.value.length <= max && input.value.length >= min) {       
                            isChecked = true
                        }else if(input.value && !input.value.match(regex) && input.value.length <= max && input.value.length >= min) {
                            undefined
                        }
                        else {
                            input.value.length == 0 ? error = "Không được để trống" : undefined
                        }
                        break;
                    }
                    case "phone" : {
                        if(input.value && input.value.match(regex) && input.value.length <= max && input.value.length >= min) {       
                            isChecked = true
                        }else if(input.value && !input.value.match(regex) && input.value.length <= max && input.value.length >= min) {
                            undefined
                        }
                        else {
                            input.value.length == 0 ? error = "Không được để trống" : undefined
                        }
                        break;
                    }
                    case "fullname" : {
                        if(input.value && input.value.match(regex) && input.value.length <= max && input.value.length >= min) {       
                            isChecked = true
                        }else {
                            input.value.length == 0 ? undefined : error = `Chỉ có thể nhập dưới ${max} kí tự`
                        }
                        break;
                    }
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
                    case "passwordAgain" : {
                        let password = document.querySelector('input[name="password"]').value
                        if(input.value && password && input.value === password ) {       
                            console.log(1)
                            isChecked = true
                        }else if(!input.value && !password ) {
                            console.log(2)
                            error = `Không được để trống`
                        }else {
                            console.log(3)
                            error = `Mật khẩu không trùng khớp`
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
        form.querySelector('input') ? form.querySelector('input').classList.remove('exactly') : undefined
        form.querySelector('input') ? form.querySelector('input').classList.add('not-exactly') : undefined
    }else {
        mess.innerHTML = ''
        form.querySelector('input') ? form.querySelector('input').classList.remove('not-exactly') : undefined
        form.querySelector('input') ? form.querySelector('input').classList.add('exactly') : undefined
    }
    return isChecked
}