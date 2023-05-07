<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <style>
        dialog::backdrop {
            background-color: rgba(0,0,0,0.5);
        }
    </style>
</head>
<body class=" font-comf h-screen m-0 transition-all">
    <button id="openBtn" style="display: none">Open</button>

    <dialog id="modal" class="w-10/12 rounded-md shadow">
        <div id="modal-body" class="my-3 list-none">

        </div>
        <button class="text-white bg-red-600 text-sm px-3 py-1 rounded-md  " id="closeBtn">Close</button>
    </dialog>
    <div class="flex h-screen flex-col">
        <div class="grow flex">
            <div class="mx-auto my-auto " id="board">
                <section id="homepage" class="font-bold text-4xl" style="display: none" data-page-number="1">
                    Welcome to Voter!
                </section>

                {{-- Form page starts here --}}
                <section id="pollpage" class="" style="display: none" data-page-number="2">
                    <div class=" w-96 h-96" id="before-vote">
                        <p class="text-4xl font-bold">Hi there! Please fill in the details below to vote.</p>
                        <form action="" method="post" id="form" class="mt-8">
                            @csrf
                            <input type="text" name="name" placeholder="Name" class="w-full border-b rounded-md my-2 focus:outline-none pl-2 py-2 text-black text-sm" id="name" value="{{ old('name') }}">

                            <input type="text" placeholder="Email" name="email" class="w-full border-b rounded-md my-2 focus:outline-none pl-2 py-2 text-black text-sm " id="email" value="{{ old('email') }}">

                            <div class="mt-3 flex space-x-1 ">
                                <label for="candidate" class="text-gray-600 text-sm ">Candidate:</label>
                                <select name="candidate" id="candidate" class=" grow">
                                    <option class="text-sm" selected value="">...</option>
                                </select>
                            </div>
        
                            <input type="submit" id="submit" value="Submit Vote" class="border w-full border-green-800 block mt-8 text-sm p-2 text-white rounded-md bg-green-800 transition-all hover:bg-white hover:text-black">
                        </form>
                    </div>
                    <div class="text-4xl font-bold" style="display: none" id="after-vote">
                        Thanks for voting! Check live results in the Results tab.
                    </div>
                </section>
                {{-- Form page ends here --}}

                {{-- Results page starts here --}}
                <section id="resultpage" class="font-bold text-center" style="display: none" data-page-number="2">
                    <div class=" w-96 h-96" id="">
                        <p class="text-4xl">Poll Results</p>
                        <p class="text-sm text-green-700">Total Stats</p>
                        <div class="flex justify-between w-11/12 mx-auto text-lg p-2 mt-24">
                            <div>Name</div>
                            <div>Vote Count</div>
                        </div>
                        <div id="palate" class="text-sm font-normal ">

                        </div>
                    </div>
                </section>
                {{-- Results page end here --}}
            </div>
        </div>
        <div class=" h-20 w-9/12 mb-5 mx-auto rounded-md transition-all bg-green-700 grid grid-cols-3 text-center">
            <span id="home" class="material-icons icon-sizing my-4 text-white cursor-pointer place-self-center ">home</span>
            <span id="poll" class="material-icons icon-sizing my-4 text-white cursor-pointer place-self-center">how_to_vote</span>
            <span id="results" class="material-icons icon-sizing my-4 text-white cursor-pointer place-self-center">poll</span>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</body>
</html>