let validate=true;


function NameValidate(n,n_er){
    if (n.value === "") {
        n_er.innerHTML = "This field can't be empty";
        n_er.style.color = "red";
        validate = false;
      } else {
        let nReg = /^[A-Za-z\s]+$/; 
        if (nReg.test(n.value)) {
          n_er.innerHTML = "";
          } else {
          n_er.innerHTML = "Invalid value";
          n_er.style.color = "red";
          validate = false;
          }

      }

}

function EmailValidate(email,em_er){
  if (email.value === "") {
    em_er.innerHTML = "This field can't be empty";
    em_er.style.color = "red";
    validate = false;
  } else {
    let emailReg = /^[A-Za-z0-9._-]+@[A-Za-z]+\.[A-Za-z]{2,3}$/;
    if (emailReg.test(email.value)) {
        emailMsg.innerHTML = "";
    } else {
        em_er.innerHTML = "Invalid email format";
        em_er.style.color = "red";
        validate = false;
    }
  }
}

function PhnValidate(phn,phn_er){
  if (phn.value === "") {
    phn_er.innerHTML = "This field can't be empty";
    phn_er.style.color = "red";
    validate = false;
  } else {
      let phnReg =/^[0-9]{10}$/;
      if (phnReg.test(phn.value)) {
          phn_er.innerHTML = "";
      } else {
          phn_er.innerHTML = "Invalid mobile number format";
          phn_er.style.color = "red";
          validate = false;
      }
  }
}

function BigTextValidate(txt,txt_er){
  if (txt.value === "") {
    txt_er.innerHTML = "This field can't be empty";
    txt_er.style.color = "red";
    validate = false;
  } else {
      let txtReg = /^[A-Za-z\s]$/;
      if (txtReg.test(txt.value)) {
          txt_er.innerHTML = "";
      } else {
          txt_er.innerHTML = "Invalid Values";
          txt_er.style.color = "red";
          validate = false;
      }
  }
}

function ZipValidate(z,z_er){
  if (z.value === "") {
    z_er.innerHTML = "This field can't be empty";
    z_er.style.color = "red";
    validate = false;
  } else {
      let zReg = /^[0-9]{6}$/;
      if (zReg.test(z.value)) {
          z_er.innerHTML = "";
      } else {
          z_er.innerHTML = "Invalid zip (length should be 6)";
          z_er.style.color = "red";
          validate = false;
      }
  }
}

function PwdValidate(pwd,pwd_er){
  if (pwd.value === "") {
    pwd_er.innerHTML = "This field can't be empty";
    pwd_er.style.color = "red";
    validate = false;
  } else {
      let pwdReg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      if (pwdReg.test(pwd.value)) {
          pwd_er.innerHTML = "";
      } else {
          pwd_er.innerHTML = "Password at least be 8 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.";
          pwd_er.style.color = "red";
          validate = false;
      }
  }
}

function ImgValidate(img,img_er){
  if (img.value === "") {
    img_er.innerHTML = "This field can't be empty";
    img_er.style.color = "red";
    validate = false;
  }else{
    img_er.innerHTML="";
  }
}

function CommanValidate(cm,cm_er){
  if (cm.value === "") {
    cm_er.innerHTML = "This field can't be empty";
    cm_er.style.color = "red";
    validate = false;
  }else{
    cm_er.innerHTML="";
  }
}

function RateValidate(r,r_er){
  if (r.value === "") {
    r_er.innerHTML = "This field can't be empty";
    r_er.style.color = "red";
    validate = false;
  }else{
    let rReg = /^[0-9]{1,100}$/;
      if (rReg.test(r.value)) {
          r_er.innerHTML = "";
      } else {
          r_er.innerHTML = "Must be in numbers";
          r_er.style.color = "red";
          validate = false;
      }
  }
}

function PriceValidate(p,p_er){
  if (p.value === "") {
    p_er.innerHTML = "This field can't be empty";
    p_er.style.color = "red";
    validate = false;
  }else{
    let pReg = /^[0-9]$/;
      if (pReg.test(p.value)) {
          p_er.innerHTML = "";
      } else {
          p_er.innerHTML = "Must be in numbers";
          p_er.style.color = "red";
          validate = false;
      }
  }
}

