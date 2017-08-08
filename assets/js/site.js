var popUp,popUpInner,popError,joinAppoinment;

$(document).ready(function(){
    
    joinAppoinment = $("div[class=joinAppoinment]");
    popUp = $("div[class=popUp]");      
    popUpInner = $("div[class=popNotification]");   
    popError = $("div[class=popError]"); 
    

    $("button[name=submitAppointmentID]").click(function(){
        popUpInner.html("");
        popError.html("");
        var appToken = $("input[name=appointmentID]").val();
        //alert(appoinmentId);
        if(appToken!="" && appToken!="3456789" && appToken.length==7){
            $.ajax({
                type:"GET",
                url:base_url+'home/sendrequest/',
                data:{
                    "appToken":appToken,
                    "isClick":"1"
                },
                async:false, 
                success:showPatientInfo
            })
        //popUp.show();
        }
        else{
            var notmessage = 'Appointment TOKEN should not be less then 7 digit';
            popUpInner.html(notmessage);           
            popUp.show();           
        }
    })
})

function hideAll()
{
    joinAppoinment.show();
    popUpInner.html("");  
    popUp.hide();  
}

function showPatientInfo(data)
{
    joinAppoinment.hide();
    if(data=='0')
    {
        var notmessage = 'Invalid Appointmennt TOKEN';
        popUpInner.html(notmessage);           
        popUp.show();         
    }
    else{
        var obj = jQuery.parseJSON(data);
        //if(obj.userLogged!='1'){
        if(obj.status=='1'){
            var statusTxt = '<input type="checkbox" name="terms" value="1" style="margin-top:-2px;"/> I have read and accept the Terms and Conditions</p> <p><input type="button" name="startAppoinment" class="btn btn-large btn-primary" value="Start my Appointment" onClick="startAppoinment()"/>';
        }
        else if(obj.status=='2')
        {
            statusTxt = 'This token was expired';
        }
            
        //        }
        //        else{
        //            statusTxt = 'Conversation is running.token cannot be taken';
        //        }
        var element = '<h3>Welcome, '+obj.username+'</h3><p><u>Appoinment Details</u><br/>Doctor : '+obj.doctorDetails.doctorName+'<br/> Time : '+obj.time+'<br/> Co-pay : $'+obj.fee+'</p><p>'+statusTxt+'</p>';
        popUpInner.html(element);           
        popUp.show();  
    }
}

function startAppoinment()
{
    popError.html("");
    var checked = $("input[name=terms]:checked").val();
    if(checked!="1")
    {
        popError.html("Please check The terms and condition");  
    }
    else
    {
        location.href = base_url+"conversation/";    
    }
}

function endAppoinment()
{
    var msg = '<h2>End Appoinment</h2><br>Are you sure you want to end this Appoinment?<br><br><p><button onclick="endingAppoinment()" class="btn btn-danger">Yes</button>';
    popUpInner.html(msg);           
    popUp.show(); 
}

function endingAppoinment()
{ 
    $.ajax({
        type:"GET",
        url:base_url+'conversation/end',
        data:{
            "isClick":"1"
        },
        async:false,
        success:endingDone
    })
}

function endingDone()
{
    location.href = base_url;
//    $("a[id=goback]").hide();
//    $("div[id=preventReload]").empty();
//    var msg = '<h2>End Appoinment</h2><br>Appoinment successfulyy ended';
//    popUpInner.html(msg);           
//    popUp.show(); 
//    
//    setTimeout(function(){
//        location.href = base_url;
//    },2000)
}

function getSupport()
{
    $.ajax({
        type:"GET",
        url:base_url+'home/support',
        data:{
            "isClick":"1"
        },
        async:false,
        success:showSupport
    })
}
function showSupport(data)
{    
    $("div[id=support]").html(data);
    $("div[id=wrapper]").hide();
}

function gotoAppointment()
{
    $("div[id=support]").html("");
    $("div[id=wrapper]").show();
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}