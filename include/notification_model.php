	<!-- Notification Container -->
	<div id="notificationContainer" class="alert fade show position-fixed top-50 start-50 translate-middle" role="notification" style="display:none">
		<h4 id="notificationHead" class="alert-heading m-2"></h4>
		<hr class="m-2">
		<div id="notificationText" class="m-2"><div id="notificationError"></div></div>
		<button type="button" id="notificationCloseButton" class="close mb-3" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

    <script>
        

        class Notify {
            constructor() {
                this.notificationContainer = document.getElementById('notificationContainer');
                this.notificationHead = document.getElementById('notificationHead');
                this.notificationText = document.getElementById('notificationText');

                this.closeButton = document.getElementById('notificationCloseButton');
                this.closeButton.addEventListener('click', () => {
                    this.#__close__();
                });
            }

            Success(Head, Body) {
                this.#__pre__();
                this.notificationContainer.classList.add('alert-success', 'border-success');
                this.notificationHead.textContent = Head;
                this.notificationText.innerHTML = Body;
                this.#__post__();
            }

            Warn(Head, Body) {
                this.#__pre__();
                this.notificationContainer.classList.add('alert-warning', 'border-warning');
                this.notificationHead.textContent = Head;
                this.notificationText.innerHTML = Body;
                this.#__post__();
            }

            Error(Head, Body) {
                this.#__pre__();
                this.notificationContainer.classList.add('alert-danger', 'border-danger');
                this.notificationText.innerHTML = Body;
                this.notificationText.innerHTML = Body;
                this.#__post__();
            }

            #__pre__() {
                this.notificationContainer.style.display = 'block';
            }

            #__post__() {
                setTimeout(() => {
                    this.#__close__();
                }, 3000);
            }

            #__close__(){
                this.notificationContainer.style.display = 'none';
                this.notificationContainer.classList.remove('alert-success', 'alert-warning', 'border-warning', 'border-success', 'alert-danger', 'border-danger');
            }
        }

        
    </script>

