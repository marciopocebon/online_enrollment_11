<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Subject Management</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>



    <body>
        <!-- Indicator for if added or updated Subject already exists -->
        <div id="existIndicator" style="display: none">
            <h2> That subject already exists  </h2>
        </div>
        
        <!-- Back to Staff Main Page -->
        <div class="staffLogin">
            <a href="/staff_main_page"> Back to Staff Main Page </a>
        </div>


        <!-- Modal for adding Subjects -->
        <div id="simpleModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeBtn">&times;</span>
                    <h2>Add Student</h2>
                </div>
                <div class="modal-body">

                    <form action="add_subject" method="post">
                    @csrf
                        <label for="subjectName">Subject Name</label><br>
                        <input type="text" class="loginInput" name="subjectName" placeholder="Enter Subject Name here..."><br>
                        <label for="room">Room</label><br>
                        <input type="text" class="loginInput" name="room" placeholder="Enter Room here..."><br>
                        <label for="capacity">Capacity</label><br>
                        <input type="number" class="loginInput" name="capacity" placeholder="Enter Capacity..."><br>
                        <label for="schedule">Schedule</label><br>
                        <input type="text" class="loginInput" name="schedule" placeholder="Enter Schedule here..."><br>

                        <input type="submit" id="modalSubmit" value="Add Subject">
                    </form>

                </div>
            </div>
        </div>


        <!-- Modal for updating Subject details -->
        <div id="updateModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeUpdateBtn">&times;</span>
                    <h2 id="modalHeader">Edit Subject Information</h2>
                </div>
                <div class="modal-body">

                    <form action="/update_subject" method="post">
                    @csrf
                    @method('put')
                        <label for="editedSubjectName">Subject Name</label><br>
                        <input type="text" class="loginInput" id="eSubName" name="editedSubjectName"><br>
                        <label for="editedCapacity">Capacity</label><br>
                        <input type="number" class="loginInput" id="eCapacity" name="editedCapacity"><br>
                        <label for="editedRoom">Room</label><br>
                        <input type="text" class="loginInput" id="eRoom" name="editedRoom"><br>
                        <label for="editedSchedule">Schedule</label><br>
                        <input type="text" class="loginInput" id="eSchedule" name="editedSchedule"><br>

                        <input type="text" id="oldSubName" class="hidden" name="oldSubName"><br>

                        <input type="submit" id="modalSubmit" value="Edit">
                    </form>

                    <form method="POST" action="/delete_subject">
                        @csrf
                        @method('delete')
                        <input type="text" id="delSubName" class="hidden" name="delSubName"><br>
                        <button type="submit" class="delete"> Delete this student </button> 
                    </form>

                </div>
            </div>
        </div>


        <!-- Modal for viewing Enrollees of a Subject  -->
        <div id="viewModal" class="modal">
            <div class="enrollee-modal-content">
                <div class="modal-header">
                    <span class="closeViewBtn">&times;</span>
                    <h2 id="modalHeader">Edit Subject Information</h2>
                </div>
                <div class="modal-body">

                <table style="width:80%;margin-left: 10%;">
                    <tr>
                    <th style="width: 25%;">ID Number</th>
                    <th style="width: 10%;">Full Name</th>
                    <th style="width: 105%;">Course</th>
                    <th style="width: 10%;"></th>
                    </tr>

                        @foreach ($subjects as $subject) 
                            <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td> 
                                <button class="unenroll"> Unenroll </button> 
                            </td>
                            </tr>
                        @endforeach
                </table>

                </div>
            </div>
        </div>

        
        <!-- Table of Subjects -->
        <div>
            <div class="content">
                <div class="studentTitle m-b-md">
                    Subject Management
                </div>

                <table class="student_table">
                    <tr>
                    <th style="width: 25%;">Subject</th>
                    <th style="width: 10%;">Enrollees</th>
                    <th style="width: 10%;"></th>
                    <th style="width: 10%;"></th>
                    </tr>

                        @foreach ($subjects as $subject) 
                            <tr>
                            <td class="subName">{{ $subject->subject_name }}</td>
                            <td>{{ $subject->enrollee()->count() }}/{{ $subject->capacity }}</td>
                            <td> 
                                <button class="editBtn"> Edit Subject </button> 
                                <h1 class="hidden">{{ $subject->capacity }}</h1>
                                <h2 class="hidden">{{ $subject->room }}</h2>
                                <h3 class="hidden">{{ $subject->schedule }}</h3>
                            </td>
                            <td>  <button class="viewBtn"> View Enrollees </button> </td>
                            </tr>
                        @endforeach
                </table>

                <div class="addStudentBtn">
                    <button id="staffModal" class="loginBtn">Add Subject</button>
                </div>

            </div>
        </div>

        <script type="text/javascript" src="/js/modal.js"></script>
        <script>
            var exists = <?php echo json_encode($exists); ?>;
        </script>
        <script type="text/javascript" src="/js/subject_management.js"></script>
    </body>
</html>