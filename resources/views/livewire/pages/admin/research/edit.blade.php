@section('title')
    {{ $titlePage }}
@endsection
<main class="flex min-h-screen">
    <livewire:components.sidebar />
    <div class="w-full bg-gray-200">
        <section class="p-4">
            <div class="w-full p-4">
                <div class="flex justify-between items-center p-4 bg-white mb-4 drop-shadow rounded">
                    <h1>
                        Edit {{ $titlePage }}
                    </h1>
                </div>
                <div class="bg-white relative drop-shadow sm:rounded-lg overflow-hidden">
                    <div class="w-full h-[35rem] p-4 bg-white rounded-lg drop-shadow-md flex flex-col">
                        <h1 class="text-xl font-semibold">Update {{ $titlePage }}</h1>
                        <small class="text-gray-500">Manage the research information below.</small>
                        <form wire:submit="updateResearch" class="flex flex-col gap-4 mt-6 w-5/12">
                            <div class="flex flex-col gap-1">
                                <label for="title">Title</label>
                                <input wire:model="title" type="text" name="title" id="title"
                                    class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="author_id" class="w-40 text-sm font-medium text-gray-900">Author</label>
                                <select wire:model="author_id" id="author_id"
                                    class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    @foreach ($authors as $author)
                                        <option wire:key="{{ $author->id }}" value="{{ $author->id }}">
                                            {{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="department_id"
                                    class="w-40 text-sm font-medium text-gray-900">Department</label>
                                <select wire:model="department_id" id="department_id"
                                    class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    @foreach ($departments as $department)
                                        <option wire:key="{{ $department->id }}" value="{{ $department->id }}">
                                            {{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="status" class="w-40 text-sm font-medium text-gray-900">Status</label>
                                <select wire:model="status" id="status"
                                    class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    @foreach ($statuses as $status)
                                        <option wire:key="{{ $status->id }}" value="{{ $status->id }}">
                                            {{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="cursor-pointer text-white bg-[#116736] py-2 rounded-md w-24">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
