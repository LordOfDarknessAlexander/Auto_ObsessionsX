<div id="Garage">
    <h1>Garage</h1>
    <button id='select'>Select</button>
    <button id='viewCar'>View</button>
    <input type='button' id='garageBackBtn' value='back'>
    <div id='userCar'>
        <img id='carImg' src='images/vehicle.jpg'>
        <!--label id='curCarName'>m:</label>
        <label id='curCarInfo'>current car info</label-->
        <label id='carName'>name</label>-
        <label id='carInfo'>info</label>
        <!---->
        <div id='progressBars'>
            <!--progress bar 'value' attribute is between 0.0 and 1.0-->
            driveterrain<progress id='drivetrainPB' value='0.0'></progress><br>
            body<progress id='bodyPB' value='0.0'></progress><br>
            interior<progress id='interiorPB' value='0.0\'></progress><br>
            documents<progress id='docsPB' value='0.0'></progress>
        </div>
    </div>
    <div id='selectedCar'>
        <img id='carImg' src='images/vehicle.jpg'>
        <label id='carName'></label>
        <label id='carInfo'></label>
        <div id='progressBars'>
            <progress id='drivetrainPB' value='0.0'></progress><br>
            <progress id='bodyPB' value='0.0'></progress><br>
            <progress id='interiorPB' value='0.0\'></progress><br>
            <progress id='docsPB' value='0.0'></progress>
        </div>
    </div>

    <!--div id='carListView'-->
        <ul id='carBtns'>
        <!--list is populated in '../program.js' from '../user.xml'
        the list items don't have to exist but the root tag must-->
        </ul>
    <!--/div-->
</div>
<div id='CarView'>
    <!--display vehicle stats and actions-->
    <button id='selectCarBtn'>Select</button>
    <button id='sellBtn'>Sell</button>
    <img id='car' src='images\\vehicle.jpg'>
    <!--div id='statLabels'>
        <lable>Drivetrain</label>
        <lable>Body</label>
        <lable>Interior</label>
        <lable>Documents</label>
    </div-->
    <!--div id='carInfoBoxes'></div-->
    <label id='carInfo'>Default Info</label>
    <button id='carViewBackBtn'>Back</button>
    <button id='homeBtn'>Home</button>
</div>