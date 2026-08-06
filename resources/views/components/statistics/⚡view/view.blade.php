<div>
    <h1>Statistics</h1>

    <div class="my-8 overflow-hidden">
        <table class="table-auto w-full border-collapse text-sm">
            <thead>
                <form wire:submit="search">
                    <tr>
                        <th class="p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400">
                            <input placeholder="Date" type="date" wire:model="date" class="
                                block
                                w-full
                                rounded-md
                                border
                                border-gray-300
                                py-2
                                pr-3
                                pl-9
                                text-gray-700
                                shadow-sm
                                placeholder:text-gray-400
                                placeholder:italic
                                focus:border-sky-500
                                focus:outline
                                focus:outline-sky-500
                            ">
                        </th>
                        <th class="p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400">
                            <input placeholder="User" type="text" wire:model="name" class="
                                block
                                w-full
                                rounded-md
                                border
                                border-gray-300
                                py-2
                                pr-3
                                pl-9
                                text-gray-700
                                shadow-sm
                                placeholder:text-gray-400
                                placeholder:italic
                                focus:border-sky-500
                                focus:outline
                                focus:outline-sky-500
                            ">
                        </th>
                        <th class="p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400">
                            <select placeholder="Action" wire:model="action" class="
                                block
                                w-full
                                rounded-md
                                border
                                border-gray-300
                                py-2
                                pr-3
                                pl-9
                                text-gray-700
                                shadow-sm
                                placeholder:text-gray-400
                                placeholder:italic
                                focus:border-sky-500
                                focus:outline
                                focus:outline-sky-500
                            ">
                                <option value="">Action</option>
                                <option value="View-page A">View-page A</option>
                                <option value="View-page B">View-page B</option>
                                <option value="Buy a cow button-click">Buy a cow button-click</option>
                                <option value="Download button-click">Download button-click</option>
                                <option value="register">Register</option>
                            </select>
                        </th>
                        <th class="p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400">
                            <button type="submit" class="
                                bg-blue-400
                                hover:bg-gray-400
                                px-10
                                py-2
                                text-white
                                text-xl
                                rounded-full
                                cursor-pointer
                                transition-colors
                                duration-300
                                shadow-md
                            ">Search</button>
                        </th>
                    </tr>
                </form>
            </thead>
        </table>
    </div>

    <div class="my-8 overflow-hidden">
        <table class="table-auto w-full border-collapse text-sm">
            <thead>
                <tr>
                    <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400">Date</th>
                    <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400">User</th>
                    <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">

            @foreach ($this->actions->items() as $action)
                <tr>
                    <td class="border-b border-gray-100 p-4 pl-8 text-gray-500">{{$action->created_at}}</td>
                    <td class="border-b border-gray-100 p-4 pl-8 text-gray-500">{{$action->user->name}}</td>
                    <td class="border-b border-gray-100 p-4 pl-8 text-gray-500">{{$action->action}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    {{ $this->actions->links() }}
</div>
