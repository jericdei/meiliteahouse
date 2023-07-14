export const dynamicDialogProps: import('primevue/dialog').DialogProps = {
    position: 'top',
    style: {
        width: '50vw',
    },
    breakpoints: {
        '960px': '75vw',
        '640px': '90vw',
    },
    modal: true,
    maximizable: false,
    draggable: false,
    closeOnEscape: false,
}
