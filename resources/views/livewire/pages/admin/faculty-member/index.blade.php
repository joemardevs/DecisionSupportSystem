@extends('livewire.layouts.app')
@section('title')
    Faculty Members
@endsection
@section('content')
    <main class="flex min-h-screen">
        <livewire:components.sidebar />
        <div class="w-full bg-gray-200">
            <section class="p-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full p-4">
                        <header class="flex justify-between items-center mb-4">
                            <h1>Faculty Members</h1>
                            <button type="button"class="text-md text-white bg-[#116736] px-4 py-1 rounded">
                                Add faculty member
                            </button>
                        </header>
                        <div class="w-full p-4 bg-white rounded-lg drop-shadow-md">
                            <table class="w-full text-sm">
                                <thead class="font-semibold border-b-2">
                                    <tr>
                                        <td class="py-2">Name</td>
                                        <td>Position</td>
                                        <td>Status</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facultyMembers as $facultyMember)
                                        <tr class="border-b">
                                            <td class="py-2">{{ $facultyMember->name }}</td>
                                            <td class="text-gray-500">{{ $facultyMember->position }}</td>
                                            <td class="text-gray-500">{{ $facultyMember->status }}</td>
                                            <td>
                                                <a href="" class="text-blue-400">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
