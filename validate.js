function checkForm()
{
    if(document.forms["newForm"].firstName.value.length ==0)
    {
        alert("You must enter a first name");
        return false;
    }
    else if(document.forms["newForm"].lastName.value.length ==0)
    {
        alert("You must enter a last name");
        return false;
    }
    else if(document.forms["newForm"].birthDate.value.length ==0)
    {
        alert("You must enter a birth date");
        return false;
    }
    else if(document.forms["newForm"].gender.value.length ==0)
    {
        alert("You must enter a gender");
        return false;
    }
    else if(document.forms["newForm"].hireDate.value.length ==0)
    {
        alert("You must enter a hire date");
        return false;
    }
    else
    {
        return true;
    }
}

function checkName(field,alertText)
{
    var myRegExp = new RegExp(/^[A-Z][a-z]/);

    if(myRegExp.test(field.value))
    {
        return true;
    }
    else
    {
        alert(alertText);
        return false;
    }
}

function checkDate(field,alertText)
{
    var myRegExp = new RegExp(/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/);

    if(myRegExp.test(field.value))
    {
        return true;
    }
    else
    {
        alert(alertText);
        return false;
    }
}

function checkGender(field,alertText)
{
    var myRegExp = new RegExp(/^(?:M|F)$/);

    if(myRegExp.test(field.value))
    {
        return true;
    }
    else
    {
        alert(alertText);
        return false;
    }
}