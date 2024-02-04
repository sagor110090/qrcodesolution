document.addEventListener("alpine:init", () => {
    Alpine.data("loader", () => ({
        isLoading: false,
        loading() {
            this.isLoading = !this.isLoading;
        },
        loadingStart() {
            this.isLoading = true;
        },
        loadingStop() {
            this.isLoading = false;
        },
    }));
});

import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});


window.alert = function (message, icon = 'success') {
    Toast.fire({
        icon: icon,
        title: message,
    });
}


