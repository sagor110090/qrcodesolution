<div {!! $attributes->merge(['class' => 'relative inline-block text-left ']) !!} >
    <div>
      <button type="button" class="flex w-full justify-center gap-x-1.5 dark:text-gray-400" id="menu-button" aria-expanded="true" aria-haspopup="true">
        Select Icon
        <svg class="-mr-1 h-5 w-5 text-gray-400 justify-end"
        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>
    <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
      <div class="py-1" role="none">
        <a href="#" class="text-gray-700 block px-4 py-2 text-sm dark:text-gray-400" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
        <form method="POST" action="#" role="none">
          <button type="submit" class="text-gray-700 block w-full px-4 py-2 text-left text-sm" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
        </form>
      </div>
    </div>
  </div>
