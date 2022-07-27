<link rel="stylesheet" href="<?= base_url() ?>assets/css/project/users-site.css" />
<style>
.group--form--radio{
    display: flex;
}
label.group--radio input[type=radio]{
    /* position: absolute; */
    /* visibility: hidden; */
    display: none;
}
label.group--radio input[type=radio]~label{  
    min-width: 60px;
    cursor: pointer;
}
label.group--radio .check{
    display: block;
    border: 2px solid #000000;
    border-radius: 100%;
    height: 18px;
    width: 18px;
    transition: border .25s linear;
    -webkit-transition: border .25s linear;
    position: relative;
    margin-right: 8px;
    /* background: #000000; */
}
label.group--radio .check::before {
    display: block;
    content: '';
    border-radius: 100%;
    height: 10px;
    width: 10px; 
    /* margin: auto; */
    transition: background 0.25s linear;
    -webkit-transition: background 0.25s linear;
    position: absolute;
    top: 2px;
    left: 2px;
}
label.group--radio input[type=radio]:checked ~ .check::before{
    background: #000000;
    border: 2px solid #fff;

}

label.group--radio input[type=radio]:checked ~ label{
    color: #000000;
}
label.group--radio{
    display: block;
    position: relative;
    font-weight: 300;
    font-size: 14px;
    /* padding: 25px 25px 25px 80px; */
    /* margin: 10px auto; */
    height: 30px;
    /* z-index: 9; */
    cursor: pointer;
    -webkit-transition: all 0.25s linear;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
    margin-right: 12px;
}
label.group--radio label{
    margin-bottom: 0px;
}
</style>