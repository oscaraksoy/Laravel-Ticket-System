@props(['title', 'subtitle', 'icon'])
<div class="hidden" id="confirmationModal">
    <div class="absolute bg-black opacity-40 w-full h-screen"></div>
    <div class="absolute top-0 right-0 bottom-0 opacity-100 left-0 h-80 m-auto rounded-lg bg-white flex flex-col items-center justify-between px-3 py-4" style="width: 32rem">
        <div class="flex-1 flex items-center flex-col justify-center">
            <i class="{{ $icon }} text-4xl mb-5"></i>
            <span class="text-xl font-medium">{{ $title }}</span>
            <span class="text-md font-medium text-gray-500 mt-5">{{ $subtitle }}</span>
        </div>
        <div class="flex flex-row justify-end w-full space-x-4 mb-2">
            <button class="flex-1 border rounded-md font-medium"  id="yesModalBtn">
                Yes
            </button>
            <button class="flex-1 p-3 bg-blue-500 rounded-md font-medium text-white" id="closeModalBtn">
                No
            </button>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        function closeModal(){
            $("#confirmationModal").attr('class', 'hidden');
        }

        async function show(){
            let modalPromise = new Promise((resolve, reject) =>{
                $("#yesModalBtn").click(function(){
                    resolve(true);
                });

                $("#closeModalBtn").click(function(){
                    resolve(false);
                });
            });

            return modalPromise;
        }


        Livewire.on('laraveltable:action:confirm', async(actionType, actionIdentifier, modelPrimary, confirmationQuestion) => {
            $("#confirmationModal").attr('class', 'visible');

            await show().then((value) => {
                if(value === true){
                    Livewire.emit('laraveltable:action:confirmed', actionType, actionIdentifier, modelPrimary);
                    closeModal();
                }else{
                    closeModal();
                }
            })
        });
    });
</script>
