export default () => ({
  datePickerOpen: false,
  datePickerValue: '',
  datePickerRealValue: '',
  datePickerFormat: 'd M, Y',
  datePickerMonth: '',
  datePickerYear: '',
  datePickerDay: '',
  datePickerDaysInMonth: [],
  datePickerBlankDaysInMonth: [],
  datePickerMonthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
  datePickerDays: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],

  datePickerDayClicked (day) {
    const selectedDate = new Date(Date.UTC(this.datePickerYear, this.datePickerMonth, day));
    this.datePickerDay = day;
    this.datePickerValue = this.datePickerFormatDate(selectedDate, this.datePickerFormat);
    this.datePickerRealValue = selectedDate;
    this.datePickerIsSelectedDate(day);
    this.datePickerOpen = false;
  },

  datePickerPreviousMonth () {
    if (this.datePickerMonth === 0) {
      this.datePickerYear--;
      this.datePickerMonth = 12;
    }
    this.datePickerMonth--;
    this.datePickerCalculateDays();
  },

  datePickerNextMonth () {
    if (this.datePickerMonth === 11) {
      this.datePickerMonth = 0;
      this.datePickerYear++;
    } else {
      this.datePickerMonth++;
    }
    this.datePickerCalculateDays();
  },

  datePickerIsSelectedDate (day) {
    const d = new Date(Date.UTC(this.datePickerYear, this.datePickerMonth, day));
    return this.datePickerValue === this.datePickerFormatDate(d, this.datePickerFormat);
  },

  datePickerIsToday (day) {
    const today = new Date();
    const d = new Date(Date.UTC(this.datePickerYear, this.datePickerMonth, day));
    return today.toDateString() === d.toDateString();
  },

  datePickerCalculateDays () {
    const daysInMonth = new Date(Date.UTC(this.datePickerYear, this.datePickerMonth + 1, 0)).getUTCDate();
    // find where to start calendar day of week
    const dayOfWeek = new Date(Date.UTC(this.datePickerYear, this.datePickerMonth)).getUTCDay();
    const blankDaysArray = [];
    for (let i = 1; i <= dayOfWeek; i++) {
      blankDaysArray.push(i);
    }
    const daysArray = [];
    for (let i = 1; i <= daysInMonth; i++) {
      daysArray.push(i);
    }
    this.datePickerBlankDaysInMonth = blankDaysArray;
    this.datePickerDaysInMonth = daysArray;
  },

  datePickerFormatDate (date, format = null) {
    const formattedDay = this.datePickerDays[date.getUTCDay()];
    const formattedDate = ('0' + date.getUTCDate()).slice(-2); // appends 0 (zero) in single digit date
    const formattedMonth = this.datePickerMonthNames[date.getUTCMonth()];
    const formattedMonthShortName = this.datePickerMonthNames[date.getUTCMonth()].substring(0, 3);
    const formattedMonthInNumber = ('0' + (parseInt(date.getUTCMonth()) + 1)).slice(-2);
    const formattedYear = date.getUTCFullYear();

    if (format && format === 'd M, Y') {
      return `${formattedDate} ${formattedMonthShortName}, ${formattedYear}`;
    }

    if (format && format === 'MM-DD-YYYY') {
      return `${formattedMonthInNumber}-${formattedDate}-${formattedYear}`;
    }

    if (format && format === 'DD-MM-YYYY') {
      return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`;
    }

    if (format && format === 'YYYY-MM-DD') {
      return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`;
    }

    if (format && format === 'D d M, Y') {
      return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`;
    }

    return `${formattedMonth} ${formattedDate}, ${formattedYear}`;
  },

  init () {
    let currentDate = new Date();

    if (this.datePickerValue) {
      currentDate = new Date(Date.parse(this.datePickerValue));
    }

    this.datePickerMonth = currentDate.getUTCMonth();
    this.datePickerYear = currentDate.getUTCFullYear();
    this.datePickerDay = currentDate.getUTCDay();
    this.datePickerValue = this.datePickerFormatDate(currentDate, this.datePickerFormat);
    this.datePickerCalculateDays();

    this.$watch('datePickerValue', () => {
      this.datePickerRealValue = new Date(Date.UTC(this.datePickerYear, this.datePickerMonth, this.datePickerDay));
    });
  }
});
