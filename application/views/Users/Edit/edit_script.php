


<script type="text/javascript" local-section="true">
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' });
        var userName = document.querySelector("input[name=userNamme]");
        var firstName = document.querySelector("input[name=firstName]");
        var lastName = document.querySelector("input[name=lastName]");
        var email = document.querySelector("input[name=email]"); 

        firstName.value = MemberInfo[0]?.firstName;
        lastName.value = MemberInfo[0]?.lastName;
        email.value = MemberInfo[0]?.email;
        document.querySelector(`input[type=radio][name=gender][value='${MemberInfo[0]?.userGender}']`).click();
    });		
</script>