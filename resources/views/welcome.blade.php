<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Voter</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])  
</head>

<body class="bg-gray-100 font-comf">
    <div class="mx-auto w-9/12">
        <div class="w-9/12 mx-auto text-center">
            <h1 class="text-4xl">Welcome to <span class="text-blue-800">Voter</span>!</h1>
        </div>

        {{-- Counter code starts here --}}
        {{-- <div class="mt-10 bg-white shadow rounded-md p-3 text-sm ">
            <p id="count_p">Current vote count: <span id="counter" class=""></span></p>
        </div> --}}
        {{-- Counter code ends here --}}
        

        {{-- Registration Code starts here --}}
        <div class="mt-10 bg-white p-10 rounded-md shadow">

            <div class="">
                <p>Hi there! Please fill in the details below to vote.</p>
            </div>
            <div class="">
                <form action="" method="post" id="form">
                    @csrf
                    <label for="name" class="text-sm">Name:</label>
                    <input type="text" name="name" class="w-full border rounded-md my-2 focus:outline-none pl-2 py-1 text-black text-sm" id="name" value="{{ old('name') }}">

                    <label for="candidate" class="text-sm">Candidate:</label>
                    <select name="candidate" id="candidate">
                        <option class="text-sm" selected value="">List of Candidates...</option>
                    </select>
                    {{-- <input type="text" name="candidate" class="w-full border rounded-md my-2 focus:outline-none pl-2 py-1 text-black text-sm" id="name" value="{{ old('candidate') }}"> --}}

                    <label for="email" class="text-sm block mt-3">Email:</label>
                    <input type="text" name="email" class="w-full border rounded-md my-2 focus:outline-none pl-2 py-1 text-black text-sm " id="email" value="{{ old('email') }}">

                    <input type="submit" id="submit" value="Submit Vote" class="border border-blue-800 block mt-3 text-sm p-2 text-white rounded-md bg-blue-800 transition-all hover:bg-white hover:text-black">
                </form>
            </div>
        </div>
        {{-- Registration code ends here --}}

        {{-- Live reload of voters starts here --}}
        <div class="mt-10 shadow bg-white text-sm mb-10 p-2 rounded-md ">
            <table class="mx-auto">
                <thead class="m" >
                    <tr class="ml-0">
                        <th class="">Name</th>
                        <th class="text-center">Vote Count</th>
                    </tr>
                </thead>
                <tbody class="">

                </tbody>
            </table>
        </div>
        {{-- Live reload of voters ends here --}}

        @include('modals')
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>
</html>