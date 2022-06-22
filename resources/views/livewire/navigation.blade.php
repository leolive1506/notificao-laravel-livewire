<div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
    <div class="flex-1 min-w-0">
        <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">
            To do
        </h1>
    </div>
    <div class="mt-4 flex sm:mt-0 sm:ml-4">
        <button type="button"
            class="ml-auto bg-gray-50 flex-shrink-0 rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-purple-500 relative">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class='inline-block h-5 -mr-1 align-text-top animate-swing origin-top relative'>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            <sup>
                <i data-count="0" class="notification-icon"></i>
                <span class="absolute top-0 inline-block w-2 h-2 rounded-full notif-count {{ !empty(count($notifications->toArray())) ? 'bg-red-500' : '' }}"></span>
            </sup>
        </button>
        <ul class="menu absolute top-10 right-0 flex flex-col items-start justify-center px-6 py-8 bg-white">
            @foreach ($notifications as $item)
                <li class="transition duration-150 ease-in-out md:mt-0 mt-8 top-0 left-0 sm:ml-10 md:ml-10 w-auto" id="{{ $item->id }}">
                    <div class="w-full min-w-full {{ !empty($item->readNofications->toArray()) ? 'bg-yellow-300' : 'bg-white' }}  dark:bg-gray-800 rounded shadow-2xl">
                        <div class="w-full h-full px-4 py-3">
                            <div class="flex justify-between items-center gap-10">
                                <div class="flex items-center">
                                    <div>
                                        <h3 class="mb-2 sm:mb-1 text-gray-800 text-base font-normal leading-4">
                                            {{ $item->message }}
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-200  text-xs leading-3">{{ $item->created_at->format('d/m/Y m:h:s') }}</p>
                                    </div>
                                </div>
                                <a class="relative font-normal text-xs sm:text-sm flex items-center text-gray-600 dark:text-gray-200" href="{{ $item->href }}" target="_blank">
                                    ver
                                </a>
                                <button class="relative font-normal text-xs sm:text-sm flex items-center text-gray-600 dark:text-gray-200" wire:click="toogleRead({{ $item->id }})">
                                    {{ empty($item->readNofications->toArray()) ? 'Marcar como lida' : 'Desmarcar como lida' }}
                                </button>
                            </div>
                            <hr class="my-2 border-t border-gray-200 dark:border-gray-700" />
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <button type="button" class="order-1 ml-3 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-0">
            Excluídos
        </button>
        <button type="button" class="order-1 ml-3 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-0" wire:click="newEvent">
            New event
        </button>
    </div>
</div>
