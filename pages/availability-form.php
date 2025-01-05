<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galactic Matchmaker</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/availability-form.css?v=2">
    <link rel="icon" href="../assets/images/newlogo.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;400;600;800&display=swap" rel="stylesheet">
</head>
<body>
<form id="availabilityForm">
<button class="back-button" type="button" onclick="window.history.back()"> 
                <span class="back-icon">&#x21A9;</span><span class="back-text">BACK</span>
            </button>
    <div class="wrapper">
        <div class="content">
        
            <div class="form-box">
            
            <!-- Campo CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <h1>DISCLAIMER: THIS FORM IS INTENDED FOR PC PLAYERS</h1>
            <input type="email" name="email" id="email" placeholder="EMAIL" required>

                
            
<select name="time_zone" id="time_zone" required>
    <option value="" disabled selected>CHOOSE YOUR TIME ZONE</option>

  
    <optgroup label="United States">
        <option value="EST">Eastern Standard Time (EST) - UTC-5</option>
        <option value="EDT">Eastern Daylight Time (EDT) - UTC-4</option>
        <option value="CST">Central Standard Time (CST) - UTC-6</option>
        <option value="MST">Mountain Standard Time (MST) - UTC-7</option>
        <option value="PST">Pacific Standard Time (PST) - UTC-8</option>
    </optgroup>

   
    <optgroup label="Europe">
        <option value="WET">Western European Time (WET) - UTC+0</option>
        <option value="CET">Central European Time (CET) - UTC+1</option>
        <option value="EET">Eastern European Time (EET) - UTC+2</option>
    </optgroup>

  
    <optgroup label="South America">
        <option value="BRT">Brasília Time (BRT) - UTC-3</option>
        <option value="ART">Argentina Time (ART) - UTC-3</option>
        <option value="CLT">Chile Standard Time (CLT) - UTC-4</option>
        <option value="PET">Peru Time (PET) - UTC-5</option>
        <option value="PYT">Paraguay Time (PYT) - UTC-4</option>
    </optgroup>

   
    <optgroup label="Asia">
        <option value="JST">Japan Standard Time (JST) - UTC+9</option>
        <option value="IST">India Standard Time (IST) - UTC+5:30</option>
    </optgroup>

   
    <optgroup label="Australia & Oceania">
        <option value="AEST">Australian Eastern Standard Time (AEST) - UTC+10</option>
        <option value="ACST">Australian Central Standard Time (ACST) - UTC+9:30</option>
        <option value="AWST">Australian Western Standard Time (AWST) - UTC+8</option>
        <option value="NZST">New Zealand Standard Time (NZST) - UTC+12</option>
    </optgroup>
</select>

    
   

            <h1>WHICH GAME MODES YOU PLAY MOST?</h1>

            
            <div id="game-modes">
                
                <div class="game-mode-selection">
                    <label><input type="checkbox" class="game-mode-checkbox" name="game_modes[]" value="Walker Assault">Walker Assault</label>
                    <label><input type="checkbox" class="game-mode-checkbox" name="game_modes[]" value="Turning Point">Turning Point</label>
                    <label><input type="checkbox" class="game-mode-checkbox" name="game_modes[]" value="Outer Rim">Outer Rim</label>
                    <label><input type="checkbox" class="game-mode-checkbox" name="game_modes[]" value="Bespin">Bespin</label>
                    <label><input type="checkbox" class="game-mode-checkbox" name="game_modes[]" value="Death Star">Death Star</label>
                    <label><input type="checkbox" class="game-mode-checkbox" name="game_modes[]" value="Scarif">Scarif</label>
                    <label><input type="checkbox" class="game-mode-checkbox" name="game_modes[]" value="Heroes Vs Villains">Heroes Vs Villains</label>
                </div>
            </div>

            <h1>WHICH DAYS YOU PLAY?</h1>

            <!-- day list -->
            <div id="days">
   
            <div class="day-selection" data-day="monday">
                
                <label><input type="checkbox" class="day-checkbox" name="days[]" value="monday"> Monday</label>
                <div class="time-slots" style="display: none;">
                    <h4>Select Time Slots for Monday:</h4>

                    
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="08:00"> 08:00 AM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="15:00"> 03:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="09:00"> 09:00 AM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="16:00"> 04:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="10:00"> 10:00 AM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="17:00"> 05:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="11:00"> 11:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="18:00"> 06:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="12:00"> 12:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="19:00"> 07:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="13:00"> 01:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="20:00"> 08:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="14:00"> 02:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="21:00"> 09:00 PM</label>
                    <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="22:00"> 10:00 PM</label>
                    <!-- <label><input type="checkbox" class="time-checkbox" name="monday_times[]" value="23:00"> 11:00 PM</label> -->
                </div>
            </div>
        </div>

                <div class="day-selection" data-day="tuesday">
                    <label><input type="checkbox" class="day-checkbox" name="days[]" value="tuesday"> Tuesday</label>
                    <div class="time-slots" style="display: none;">
                        <h4>Select Time Slots for Tuesday:</h4>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="08:00"> 08:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="15:00"> 03:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="09:00"> 09:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="16:00"> 04:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="10:00"> 10:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="17:00"> 05:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="11:00"> 11:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="18:00"> 06:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="12:00"> 12:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="19:00"> 07:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="13:00"> 01:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="20:00"> 08:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="14:00"> 02:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="21:00"> 09:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="22:00"> 10:00 PM</label>
                     <!--   <label><input type="checkbox" class="time-checkbox" name="tuesday_times[]" value="23:00"> 11:00 PM</label> -->
                        
                    </div>
                </div>
                <div class="day-selection" data-day="wednesday">
                    <label><input type="checkbox" class="day-checkbox" name="days[]" value="wednesday"> Wednesday</label>
                    <div class="time-slots" style="display: none;">
                        <h4>Select Time Slots for Wednesday:</h4>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="08:00"> 08:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="15:00"> 03:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="09:00"> 09:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="16:00"> 04:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="10:00"> 10:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="17:00"> 05:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="11:00"> 11:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="18:00"> 06:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="12:00"> 12:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="19:00"> 07:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="13:00"> 01:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="20:00"> 08:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="14:00"> 02:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="21:00"> 09:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="22:00"> 10:00 PM</label>
                      <!--  <label><input type="checkbox" class="time-checkbox" name="wednesday_times[]" value="23:00"> 11:00 PM</label> -->
                        
                    </div>
                </div>

                <div class="day-selection" data-day="thursday">
                    <label><input type="checkbox" class="day-checkbox" name="days[]" value="thursday"> Thursday</label>
                    <div class="time-slots" style="display: none;">
                        <h4>Select Time Slots for Thursday:</h4>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="08:00"> 08:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="15:00"> 03:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="09:00"> 09:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="16:00"> 04:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="10:00"> 10:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="17:00"> 05:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="11:00"> 11:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="18:00"> 06:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="12:00"> 12:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="19:00"> 07:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="13:00"> 01:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="20:00"> 08:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="14:00"> 02:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="21:00"> 09:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="22:00"> 10:00 PM</label>
                     <!--   <label><input type="checkbox" class="time-checkbox" name="thursday_times[]" value="23:00"> 11:00 PM</label> -->
                        
                    </div>
                </div>

                <div class="day-selection" data-day="friday">
                    <label><input type="checkbox" class="day-checkbox" name="days[]" value="friday"> Friday</label>
                    <div class="time-slots" style="display: none;">
                        <h4>Select Time Slots for Friday:</h4>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="08:00"> 08:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="15:00"> 03:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="09:00"> 09:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="16:00"> 04:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="10:00"> 10:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="17:00"> 05:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="11:00"> 11:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="18:00"> 06:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="12:00"> 12:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="19:00"> 07:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="13:00"> 01:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="20:00"> 08:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="14:00"> 02:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="21:00"> 09:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="22:00"> 10:00 PM</label>
                   <!--     <label><input type="checkbox" class="time-checkbox" name="friday_times[]" value="23:00"> 11:00 PM</label> -->
                        
                    </div>
                </div>

                <div class="day-selection" data-day="saturday">
                    <label><input type="checkbox" class="day-checkbox" name="days[]" value="saturday"> Saturday</label>
                    <div class="time-slots" style="display: none;">
                        <h4>Select Time Slots for Saturday:</h4>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="08:00"> 08:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="15:00"> 03:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="09:00"> 09:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="16:00"> 04:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="10:00"> 10:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="17:00"> 05:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="11:00"> 11:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="18:00"> 06:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="12:00"> 12:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="19:00"> 07:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="13:00"> 01:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="20:00"> 08:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="14:00"> 02:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="21:00"> 09:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="22:00"> 10:00 PM</label>
                       <!--  <label><input type="checkbox" class="time-checkbox" name="saturday_times[]" value="23:00"> 11:00 PM</label> -->
                        
                    </div>
                </div>

                <div class="day-selection" data-day="sunday">
                    <label><input type="checkbox" class="day-checkbox" name="days[]" value="sunday"> Sunday</label>
                    <div class="time-slots" style="display: none;">
                        <h4>Select Time Slots for Sunday:</h4>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="08:00"> 08:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="15:00"> 03:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="09:00"> 09:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="16:00"> 04:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="10:00"> 10:00 AM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="17:00"> 05:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="11:00"> 11:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="18:00"> 06:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="12:00"> 12:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="19:00"> 07:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="13:00"> 01:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="20:00"> 08:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="14:00"> 02:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="21:00"> 09:00 PM</label>
                        <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="22:00"> 10:00 PM</label>
                   <!--     <label><input type="checkbox" class="time-checkbox" name="sunday_times[]" value="23:00"> 11:00 PM</label> -->
                        
                    </div>
                </div>
            </div>
            <button id="submitBtn" type="submit">SUBMIT</button>
            <div id="messages">
                <div id="errorMessages"></div>
                <div id="successMessages"></div>
                <div id="debugMessages" style="color: blue; white-space: pre-wrap;"></div> 
                
            </div>
        </div>

</form>
</div>
    </div>            

<?php include 'footer.php'; ?>

<script>
    const firstSelectedTimes = new Set(); 
    let isFirstDaySelected = false; 

    function syncSelectedTimes(dayElement) {
        
        const timeCheckboxes = dayElement.querySelectorAll('.time-checkbox');
        timeCheckboxes.forEach(checkbox => {
            checkbox.checked = firstSelectedTimes.has(checkbox.value);
        });
    }

    document.querySelectorAll('.day-checkbox').forEach(dayCheckbox => {
        dayCheckbox.addEventListener('change', function() {
            const dayElement = this.closest('.day-selection');
            const timeSlots = dayElement.querySelector('.time-slots');

           
            timeSlots.style.display = this.checked ? 'block' : 'none';

           
            if (this.checked && !isFirstDaySelected) {
                isFirstDaySelected = true;
                dayElement.querySelectorAll('.time-checkbox').forEach(timeCheckbox => {
                    if (timeCheckbox.checked) {
                        firstSelectedTimes.add(timeCheckbox.value);
                    }
                });
            } else if (this.checked && isFirstDaySelected) {
                
                syncSelectedTimes(dayElement);
            }

            updateSubmitButtonState();
        });
    });


   document.querySelectorAll('.time-checkbox').forEach(timeCheckbox => {
     timeCheckbox.addEventListener('change', function() {
       if (isFirstDaySelected && timeCheckbox.closest('.day-selection').querySelector('.day-checkbox').checked) {
         if (timeCheckbox.checked) {
           firstSelectedTimes.add(timeCheckbox.value);
         } else {
           firstSelectedTimes.delete(timeCheckbox.value);
         }
       }
       updateSubmitButtonState();
     });
   });
   
   
   function updateSubmitButtonState() {
     const anyDayChecked = [...document.querySelectorAll('.day-checkbox')].some(dayCheckbox => dayCheckbox.checked);
     const anyTimeChecked = [...document.querySelectorAll('.time-checkbox')].some(timeCheckbox => timeCheckbox.checked);
     document.getElementById('submitBtn').disabled = !(anyDayChecked && anyTimeChecked);
   }
   
   

   document.getElementById('availabilityForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const email = document.getElementById('email').value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        displayErrors(['Invalid email format. Please correct it before submitting.']);
        return; 
    }

    
   
    const formData = new FormData(this);
    formData.append('email', email);
    submitForm(formData);
});

function submitForm(formData) {
    fetch('../functions/availability-processing.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Server responded with status ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('errorMessages').innerHTML = '';
        document.getElementById('successMessages').innerHTML = '';
        document.getElementById('debugMessages').innerHTML = '';

        if (data.status === 'error') {
            displayErrors(data.message);
        } else if (data.status === 'success') {
            displaySuccess(data.message);
            const userEmail = data.email;
            document.getElementById('availabilityForm').reset();
        }

        if (data.debug) {
            displayDebug(data.debug);
        }

        
    })
    .catch(error => {
        console.error('Error submitting form:', error);
        displayErrors(['An unexpected error occurred. Please try again later.']);
    });
}

function displayErrors(errors) {
    const errorContainer = document.getElementById('errorMessages');
    errorContainer.innerHTML = '';

    if (!errors || errors.length === 0) {
        errorContainer.innerHTML = '<p>No errors found. Please try again later.</p>';
        return;
    }

    errors.forEach(error => {
        const errorElement = document.createElement('p');
        errorElement.textContent = error;
        errorElement.style.color = 'red';
        errorElement.style.fontWeight = 'bold';
        errorContainer.appendChild(errorElement);
    });

    errorContainer.setAttribute('aria-live', 'assertive');
}

function displaySuccess(message) {
    const successContainer = document.getElementById('successMessages');
    successContainer.innerHTML = `<p>${message}</p>`;
}

function displayDebug(message) {
    const debugContainer = document.getElementById('debugMessages');
    debugContainer.innerHTML = `<p>${message}</p>`;
}
</script>
</body>
</html>
