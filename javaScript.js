                                               
function EMPlogin() {
  location.href="EMP_login.php";
}
 

function MANlogin() {
  location.href="MAN_login.php";
}

function EMPPage() {
     location.href="EMP_page.php";
}
function MANPage() {
     location.href="MAN_page.php";
}

//validation for signup 
function validatesignup(){
	let x = document.forms["form2"]["EMPfristName"].value;
	let y = document.forms["form2"]["EMPlastName"].value;
	let z = document.forms["form2"]["EMPid"].value;
	let a = document.forms["form2"]["EMPjobTitle"].value;
	let b = document.forms["form2"]["EMPpassword"].value;

	if (x == ""  ||  y ==""||  z ==""||  a ==""||  b ==""){
	alert("You must fill out all the fields");}
	else{
	//if (Number.isInteger(x))
		//alert("Only characters are accepted");

	//else
	EMPPage();
	}
}
//validation for MANform 
function validateMANForm(){
	let x = document.forms["form3"]["MANname"].value;
	let y = document.forms["form3"]["MANpassword"].value;
	if (x == ""  ||  y ==""){
	alert("You must fill out all the fields");}
	else{
	if (Number.isInteger(x))
		alert("Only characters are accepted");

	else
	MANPage();
	}
}
//validation for EMPform 
function validateEMPForm(){
	let x = document.forms["form1"]["EMPname"].value;
	let y = document.forms["form1"]["EMPpassword"].value;
	if (x == ""  ||  y ==""){
	alert("You must fill out all the fields");}
	else{
	if (Number.isInteger(x))
		alert("Only characters are accepted");

	else
		EMPPage();
	}
}

/*
function EmpName(){
var name = document.getElementById("EMPname");
  document.getElementById("demo").innerHTML="NAME: " +name;
}
function EmpName(loginForm){
	if(loginForm.EMPName.value &&loginForm.EMPpassword.value){
var name = document.getElementById("EMPname").value;
document.write("welcome"+" ");
document.write(name);
}
	else 
		alert("enter name and password")

}
function mygunction(){
	document.getElementById("demo").innerHTML = "welcome hhhhh SuperManageKSU";
}

function mygunction(){
	document.getElementById("demo").innerHTML = "welcome hhhhhhhhh SuperManageKSU";
}

document.getElementById("MANname")
function MANNAME(){
	localStorage.setItem(MANfristName, document.getElementById("MANname").value);
}


function validateForm() {
	let x = document.forms["form1"]["EMPname"].value;
	if (x == "" )
		alert("Name must be filled out");
	return false;
}
function singUp(){
	localStorage.setItem(EMPfristName, document.getElementById("EMPfristName").value);
	localStorage.setItem(EMPlastName, document.getElementById("EMPlastName").value);
	localStorage.setItem(EMPid, document.getElementById("EMPid").value);
	localStorage.setItem(EMPjobTitle, document.getElementById("EMPjobTitle").value);
	localStorage.setItem(EMPpassword, document.getElementById("EMPpassword").value);
	EMPpage();
}


 */
/*
//add request/edit validation
function check() {

	var num = document.forms["addform"]["reqfile"].files.length;

	if (num > 2) {
		alert("Only 2 files are allowed to upload.");
		document.getElementById("reqfile").value = null;
	}
	else
		window.location.href = "reqinfo.html";
}

//information Request page
function infoDes() {

	document.getElementById("reqDesc").innerHTML = "Request Description: I am eligible for promotion";
	document.getElementById("reqfile").innerHTML = "<a href=leavefile.pdf target=blank>Leave form</a>";

	var x = document.createElement("IMG");
	x.setAttribute("src", "img/sickLeave.jpeg");
	document.getElementById("reqimg").appendChild(x);

}
*/

function twitter(){
	alert("You can contact us via our Twitter account: @SuperManageKSU");
}
function email(){
	alert("You can contact us via email: KUSEmployee@hotmail.com");
}
function phone(){
	alert("You can call us on the following number : +966 51234567");
}
