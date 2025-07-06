function SaveenquiryDetails() {

   /* document.getElementById("SvPInfo").innerHTML = "<img src='UserProfileImg/loading2.gif' />";*/
    document.getElementById("SubmitEnqueryContact").disabled = true;
    $("#SubmitEnqueryContact").html('Please wait...');
    //$('#SvPInfo').html("<img src='UserProfileImg/loading2.gif' />");

    var od = new FormData();
    var name = document.getElementById("txtname").value;
    //var Subject = document.getElementById("txtsubject").value;
    var emailaddress = document.getElementById("txtemail").value;
    var contactno = document.getElementById("txtphone").value;
    var enqdesc = document.getElementById("enqdesc").value;

    /////
    od.append("name", name);
    //od.append("subject", Subject);
    od.append("emailaddress", emailaddress);
    od.append("contactno", contactno);
    od.append("enqdesc", enqdesc);
    /////
    jQuery.ajax({
        url: "handler/Contact-Enquery.ashx",
        type: "POST",
        contentType: false,
        processData: false,
        data: od,
        dataType: "json",
        success: function (Response) {
            if (Response.Success) {
                //$.messager.alert("Success", Response.Message, 'info');
            
                swal("Request Submitted!", Response.Message, "success");
                $('#txtname').val('');
                $('#txtemail').val('');
                //$('#txtsubject').val('');
                $('#txtphone').val('');
                $('#enqdesc').val('');
                document.getElementById("SubmitEnqueryContact").disabled = false;
                $("#SubmitEnqueryContact").html('Send Message');
            }
            else {
                //$.messager.alert("Warning", Response.Message, 'warning');
                swal({
                    title: "Sorry!",
                    text: Response.Message,
                    type: "Warning"

                });
                document.getElementById("SubmitEnqueryContact").disabled = false;
                $("#SubmitEnqueryContact").html('Send Message');
            }
        },
        error: function (err) {
            //$.messager.alert("Failed", err.statusText, 'error');
            swal({
                title: "Sorry!",
                text: err.statusText,
                type: "error"

            });
            document.getElementById("SubmitEnqueryContact").disabled = false;
            $("#SubmitEnqueryContact").html('Send Message');
        }
    });
}
//////////
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode == 46 && evt.srcElement.value.split('.').length > 1) {
        return false;
    }
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
    /////////