<x-layout>
  <main class="container">
    <header class="full-width">
      <Span>Contact Us</Span>
    </header>
    <div class="flex-wrapper contact">
      <div class="main-content">
        <h2>We would love to hear from you.</h2>
        <p class="text-secondary">If you have any query or any type of suggestion, you can contact us or send us a message here.</p>
        <form action="" class="contactform" method="POST">
          @csrf
          <div class="form-group-wide">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea rows="10" name="message" id=""></textarea>
          </div>
          <button type="submit">Send Message</button>
        </form>
      </div>
      <aside class="aside">
        <div>
          <h3>Visit Us</h3>
          <p class="text-secondary">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel repellendus laboriosam totam.</p>
        </div>
        <br>
        <div>
          <h3>Get in Touch</h3>
          <p class="text-secondary">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel repellendus laboriosam totam.</p>
        </div>
      </aside>

    </div>
  </main>
</x-layout>