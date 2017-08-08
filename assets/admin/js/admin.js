function deleteAppoiment(id,url)
{
    var msg = '<h2>Delete Appointment</h2><br>Are you sure you want to delete this Appointment?<br><br><p><button onclick="delAppointment(\''+id+'\',\''+url+'\')" class="blue">Yes</button>';
    popup(msg);
    return false;
}

function delAppointment(id,url)
{   
    $.ajax({
        type:"GET",
        url:base_url+url,
        data:{
            "isclick":"1",
            "appId":id
        },
        success:function(response)
        {
            if(response=='1')
            {
                $("tr[id="+id+"]").remove();
                //var msg = '<h2>Delete Appointment</h2><br>Appointment Successfully Deleted<br><br>';
                //popup(msg);
                
                window.location.reload();
            }
        }
    })
}

function hideAll()
{
    $("div[class=popUp]").hide().html("");
}

function popup(param)
{
    var text = '<div id="popup"><div id="frame"> '+param+' &nbsp; <a id="goback" href="javascript:;" onclick="hideAll()">Go Back</a></p></div></div>';
    $("div[class=popUp]").show().html(text);
}


function appointmentValidation(){
    var noError=true;
        
    if($('input[name=username]').val()=='')
    {
        $('p[id=errorName]').slideDown();
        noError=false;
    }
    else
    {
        $('p[id=errorName]').slideUp();
    }
        
    if($('select[name=datepicker]').val()=='')
    {
        $('p[id=errorDate]').slideDown();
        noError=false;
    }
    else
    {
        $('p[id=errorDate]').slideUp();
    }
        
    if($('input[name=fee]').val()=='')
    {
        $('p[id=errorFee]').slideDown();
        noError=false;
    }
    else
    {
        $('p[id=errorFee]').slideUp();
    }
        
    if($('select[name=doctorId]').val()=='')
    {
        $('p[id=errorDoctor]').slideDown();
        noError=false;
    }
    else
    {
        $('p[id=errorDoctor]').slideUp();
    }
    
    //check current time zone
       
        
    return noError;
}

function startAppointment(token,url)
{
    $.ajax({
        type:"GET",
        url:base_url+url,
        data:{
            "token":token,
            "isStart":"1"
        },
        async:false,
        success:showAppoinmentWindow
    })
}
function showAppoinmentWindow(data)
{
    data = data + '<a href="javascript:;" onclick="gotoApointment()">Go Back</a>';
    $("div[id=main]").hide();
    $("div[class=adminConversation]").show().html(data);
    
}

function gotoApointment()
{
    $("div[id=main]").show();
    $("div[class=adminConversation]").hide().html("");
}

function markascompleted(id,url)
{
    var msg = '<h2>Completed Appointment</h2><br>Are you sure you want to mark this Appointment Completed?<br><br><p><button onclick="completedAppointment(\''+id+'\',\''+url+'\')" class="blue">Yes</button>';
    popup(msg);
}
function markasnoshow(id,url)
{
    var msg = '<h2>Mark As No Show</h2><br>Are you sure you want to mark this Appoinmetnt No Show?<br><br><p><button onclick="noshow(\''+id+'\',\''+url+'\')" class="blue">Yes</button>';
    popup(msg);
}
function endAppoinment(id,url)
{
    var msg = '<h2>End Appointment</h2><br>Are you sure you want to mark this Appointment As End?<br><br><p><button onclick="doend(\''+id+'\',\''+url+'\')" class="blue">Yes</button>';
    popup(msg);
}

function completedAppointment(id,url)
{
    $.ajax({
        type:"GET",
        url:base_url+url,
        data:{
            "id":id,
            "isStart":"1"
        },
        success:function(response){
            if(response=='1')
            {
                $("div[id=preventReload]").empty();
                
                $("tr[id="+id+"]").remove();
               
                var msg = '<h2>Completed Appointment</h2><br>Appointment Mark As Completed Successfully Done<br><br>';
                popup(msg);
                
                $("a[id=goback]").hide();
                
                setTimeout(function(){
                    location.href = base_url+'administrator/appointment.php';
                },2000)
            }
        }
    })
}

function noshow(id,url)
{
    $.ajax({
        type:"GET",
        url:base_url+url,
        data:{
            "id":id,
            "isStart":"1"
        },
        success:function(response){
            if(response=='1')
            {
                $("div[id=preventReload]").empty();
                
                $("tr[id="+id+"]").remove();
                var msg = '<h2>No Show Appointment</h2><br>Appointment Mark As No Show Successfully Done<br><br>';
                popup(msg);
                $("a[id=goback]").hide();
                setTimeout(function(){
                    location.href = base_url+'administrator/appointment.php';
                },2000)
            }
        }
    })
}

function doend(id,url)
{
    //location.href = base_url+'administrator/appointment.php'
    $.ajax({
        type:"GET",
        url:base_url+url,
        data:{
            "id":id,
            "isStart":"1"
        },
        success:function(response){
            if(response=='1')
            {
                location.href = base_url+'administrator/appointment.php';
            //                $("div[id=preventReload]").empty(); 
            //                
            //                $("tr[id="+id+"]").remove();
            //                var msg = '<h2>End Appointment</h2><br>Appointment Mark As End Successfully Done<br><br>';
            //                popup(msg);
            //                $("a[id=goback]").hide();
            //                setTimeout(function(){
            //                    location.href = base_url+'administrator/appointment.php';
            //                },2000)
            }
        }
    })
}
function changeTimeZone(value)
{
    $.ajax({
        type:"GET",
        url:base_url+'administrator/timezone',
        data:{
            "zone":value,
            "isChange":"1"
        },
        success:function(res)
        {
            location.reload();
        }
    })
}