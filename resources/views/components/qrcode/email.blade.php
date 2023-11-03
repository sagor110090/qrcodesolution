@props([
    'email' => '',
    'subject' => '',
    'message' => '',
])
<div class="border-neutral-100 px-6 py-4 dark:border-neutral-500" x-show="type === 'email'">
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <span class="mr-2 font-bold text-md">
            Enter your email address
        </span>
    </h5>
    <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300">
        <x-tw.input label="Email" placeholder="Email" id="email" type="email" helper="Ex: hello@qrcodesolution.com" name="email" value="{{ $email }}" />
        <x-tw.input label="Subject" placeholder="Subject" id="subject" type="text" helper="Ex: Hello from QR Code Solution" name="subject" value="{{ $subject }}" />
        <x-tw.textarea label="Message" placeholder="Message" id="message" required class="col-span-2" name="message" value="{{ $message }}" />

    </div>

</div>
