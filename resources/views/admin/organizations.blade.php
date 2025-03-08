<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Organizations</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    </head>
    <body class="bg-#e0e0e2 animate-fade_in">
        @include('admin.header')
        @include('admin.sidebar')

        <div class="pb-16 animate-fade_in font-inter">
            <div class="px-10 mt-8">
                <h1 class="font-inter text-3xl font-extrabold">Organizations</h1>
            </div>

            @if(session('success'))
                <div class="px-10 mt-4">
                    <div id="success-alert" class="bg-green-500 text-white p-4 rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="flex flex-wrap px-10 mt-7">
                @foreach($organization_members as $manager)
                    <div class="w-full mb-4 bg-[#ececec] p-4 border border-[#cdcdcd] rounded-lg shadow-xl p-7">
                        <span class="text-xxs text-gray-500 font-normal">ORGANIZATION:</span>
                        <h3 class="text-lg font-semibold mb-4 uppercase">{{ $manager->organizations_name }}</h3>
                        <span class="text-xxs text-gray-500">MANAGER:</span>
                        <p class="text-normal text-black font-semibold mb-4">{{ $manager->first_name }} {{ $manager->last_name }}</p>

                        <table class="min-w-full border-collapse border border-gray-300 bg-gray-200">
                            <thead>
                                <tr class="bg-gray-300 border border-gray-300">
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold">Member Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold">Role</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manager->members as $member)
                                    <tr class="border border-gray-300">
                                        <td class="text-sm border border-gray-300 px-4 py-2">{{ $member->first_name }} {{ $member->last_name }}</td>
                                        <td class="text-sm border border-gray-300 px-4 py-2">{{ ucfirst($member->role) }}</td>
                                        <td class="text-sm border border-gray-300 px-4 py-2">
                                            <!-- form for switching roles -->
                                            <form action="{{ route('admin.switch_role', ['manager_id' => $manager->id, 'member_id' => $member->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-blue-500 hover:text-blue-700">Switch Roles</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
