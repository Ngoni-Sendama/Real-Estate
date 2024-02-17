<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @else
        <form id="contact-form" wire:submit.prevent="save">
            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <label for="name">Full Name</label>
                        <input type="name" name="name" wire:model="name" placeholder="Your Name..." autocomplete="on"
                            required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset>
                        <label for="email">Email Address</label>
                        <input type="text" name="email" wire:model="email" id="email" pattern="[^ @]*@[^ @]*"
                            placeholder="Your E-mail..." required="">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset>
                        <label for="subject">Subject</label>
                        <input type="subject" name="subject" wire:model="subject" id="subject"
                            placeholder="Subject..." autocomplete="on">
                        @error('subject')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset>
                        <label for="message">Message</label>
                        <textarea name="message" id="message" wire:model="messsage" placeholder="Your Message"></textarea>
                        @error('message')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset>
                        <button type="submit" id="form-submit" class="orange-button">Send Message</button>
                    </fieldset>
                </div>
            </div>
        </form>
    @endif
</div>
