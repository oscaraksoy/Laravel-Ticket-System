@props(['type'])
<div class="rounded px-6 py-2 text-center w-24 text-white
{{
    ($type == 1 ? "bg-green-500" :
    ($type == 2 ? "bg-blue-500" :
    ($type == 3 ? "bg-red-500": '')))
}}
">
    <span class="font-bold">
        {{
    ($type == 1 ? "Open" :
    ($type == 2 ? "Replied" :
    ($type == 3 ? "Closed": "")))
}}
    </span>
</div>
