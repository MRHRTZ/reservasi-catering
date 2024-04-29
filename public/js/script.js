const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0
    }).format(number);
}

$(document).ready(function () {
    $('.rupiah').each(function (i, obj) {
        $(obj).text(rupiah(Number($(obj).text())))
    });
});