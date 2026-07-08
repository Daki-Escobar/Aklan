console.log("AklanRide Loaded Successfully!");

/*======*/

const registerForm = document.getElementById("registerForm");

if (registerForm) {

    registerForm.addEventListener("submit", async function(e){

        e.preventDefault();

        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        const response = await fetch("../api/register.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/json"
            },

            body:JSON.stringify({

                name:name,
                email:email,
                password:password

            })

        });

        const result = await response.json();

        alert(result.message);

        if(result.status){

            window.location.href="login.php";

        }

    });

}

/*===*/

const loginForm = document.getElementById("loginForm");

if (loginForm) {

    loginForm.addEventListener("submit", async function(e){

        e.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        const response = await fetch("../api/login.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                email: email,
                password: password
            })

        });

        const result = await response.json();

        alert(result.message);

        if(result.status){

            if(result.role === "admin"){

                window.location.href="../admin/dashboard.php";

            }else{

                window.location.href="dashboard.php";

            }

        }
    });

}

/* ==========================
   BOOK RIDE FARE
==========================*/

const vehicle = document.getElementById("vehicle");
const fare = document.getElementById("fare");

if(vehicle){

    vehicle.addEventListener("change", function(){

        if(vehicle.value === "Motorcycle"){

            fare.innerHTML = "₱80";

        }else{

            fare.innerHTML = "₱120";

        }

    });

}

/* ==========================
   BOOK RIDE
========================== */

const bookingForm = document.getElementById("bookingForm");

if (bookingForm) {

    bookingForm.addEventListener("submit", async function(e){

        e.preventDefault();

        const pickup = document.getElementById("pickup").value;
        const destination = document.getElementById("destination").value;
        const vehicle = document.getElementById("vehicle").value;
        const payment = document.getElementById("payment").value;

        let fare = 80;

        if(vehicle === "Tricycle"){
            fare = 120;
        }

        const response = await fetch("../api/bookride.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/json"
            },

            body:JSON.stringify({

                pickup:pickup,
                destination:destination,
                vehicle:vehicle,
                payment:payment,
                fare:fare

            })

        });

        const result = await response.json();

        alert(result.message);

        if(result.status){

             window.location.href =
                "payment.php?booking_id=" +
                result.booking_id +
                "&fare=" +
                result.fare;
        }

    });

}

const paymentForm = document.getElementById("paymentForm");

if(paymentForm){

    paymentForm.addEventListener("submit", async function(e){

        e.preventDefault();

        const fare = document.getElementById("fare").value;
        const method = document.getElementById("method").value;

        const response = await fetch("../api/payment.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/json"
            },

            body:JSON.stringify({

                user:sessionStorage.getItem("user"),
                booking_id:Date.now(),
                fare:fare,
                method:method

            })

        });

        const result = await response.json();

        alert(result.message);

        if(result.status){

            window.location.href="history.php";

        }

    });

}

