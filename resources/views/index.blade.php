
@extends('layout')
@section('title', 'Students')
@section('content')
<h2 class="input-group justify-content-center">Students</h2>

    <div class="input-group justify-content-center ">
        <div class="form-outline row" data-mdb-input-init>
            <input id="searchS" name="searchS" type="search" id="form1" class="form-control col-md m-3" placeholder="Search by name" />
            <input id="searchA" name="searchA" type="search" id="form1" class="form-control col-md m-3" placeholder="Search by age" />
        </div>
    </div>
    

<table id="studentList" class="table mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody id="student-table">
    @foreach($students as $student)
                <tr class="border border-gray-300">
                    <td class="px-4 py-2 border border-gray-300">{{ $student->id }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $student->name }}</td>
                    <td class="px-4 py-2 border border-gray-300 flex space-x-2">{{ $student->age }}</td>
                </tr>
                @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        // Search by name
        $('#searchS').on('keyup', function() {
            let query = $(this).val().trim(); // Remove unnecessary spaces

            $.ajax({
                url: '/students',
                method: 'GET',
                data: { searchS: query }, // Send the correct parameter for name search
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    console.log("Students Data:", response); // Debugging Log
                    let studentList = '';
                    if (response.length > 0) {
                        response.forEach(function(student) {
                            studentList += `
                                <tr class="border border-gray-300">
                                    <td class="px-4 py-2 border border-gray-300">${student.id}</td>
                                    <td class="px-4 py-2 border border-gray-300">${student.name}</td>
                                    <td class="px-4 py-2 border border-gray-300 flex space-x-2">${student.age}</td>
                                </tr>`;
                        });
                    } else {
                        studentList = `<li class="text-gray-500 text-center p-4">No students found</li>`;
                    }
                    $('#studentList').html(studentList);
                },
                error: function(xhr, status, error) {
                    console.log("Error fetching students:", xhr.responseText); // Debugging Log
                }
            });
        });

        // Search by age
        $('#searchA').on('keyup', function() {
            let query = $(this).val().trim(); // Remove unnecessary spaces

            $.ajax({
                url: '/students',
                method: 'GET',
                data: { age: query }, // Send the age as the query parameter
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    console.log("Students Data:", response); // Debugging Log
                    let studentList = '';
                    if (response.length > 0) {
                        response.forEach(function(student) {
                            studentList += `
                                <tr class="border border-gray-300">
                                    <td class="px-4 py-2 border border-gray-300">${student.id}</td>
                                    <td class="px-4 py-2 border border-gray-300">${student.name}</td>
                                    <td class="px-4 py-2 border border-gray-300 flex space-x-2">${student.age}</td>
                                </tr>`;
                        });
                    } else {
                        studentList = `<li class="text-gray-500 text-center p-4">No students found</li>`;
                    }
                    $('#studentList').html(studentList);
                },
                error: function(xhr, status, error) {
                    console.log("Error fetching students:", xhr.responseText); // Debugging Log
                }
            });
        });
    });
</script>

@endsection