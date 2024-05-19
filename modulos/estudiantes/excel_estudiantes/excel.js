$(document).ready(function (){

    var _workBook;

    window.generate_template = generate_template;

    function generate_template(data){
        _workBook = new ExcelJS.Workbook;
        _workBook.creator = 'Me';

        generate_sheet(data.data);

        generate_data_sheet_for_validators(data.dataClassValidators);
    
        downloadTemplate(_workBook);
        
    }
    
    function generate_sheet(data){
        const sheet = _workBook.addWorksheet('prueba');
        
        sheet.columns = [
            {header: "Clave alumno", key: "id"},
            {header: "Nombres", key: 'studentName'},
            {header: 'Apellidos', key: 'studentLastNames'},
            {header: 'Correo', key: 'studentEmail'},
            {header: 'Puesto', key: 'studentPosition'},
            {header: 'Clase', key: 'studentClass'},
            {header: 'Nota Total (opcional)', key: 'studentNote'}
        ];

        if(data) insertStudentData(sheet, data);
    }
    
    function downloadTemplate(workbook) {
        workbook.xlsx.writeBuffer().then((buffer) => {
            const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'example.xlsx';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        });
    }


    function generate_data_sheet_for_validators(validator){
        const sheet = _workBook.addWorksheet('validators');
        
        validator.forEach(function(element, index) {
            let dataColumn = sheet.getColumn(index+1);
            dataColumn.values = element.data;
            generate_data_validators(element.column, 1, element.data.length, dataColumn.letter);
        });
        
        sheet.state = 'veryHidden';
    }

    function generate_data_validators(validationColumn, sheetNumber, dataLength, columnForValidationPage){
        const sheet = _workBook.getWorksheet(sheetNumber);

        const column = sheet.getColumn(validationColumn);

        for (let i = 2; i < 500; i++) {
            sheet.getCell(`${column.letter}${i}`).dataValidation = {
                type: 'list',
                allowBlank: false,
                showErrorMessage: true,
                formulae: ['validators!$' + columnForValidationPage + '$1:validators!$' + columnForValidationPage + '$' + dataLength]
            };
        }        
    }

    function insertStudentData(sheet, data){
        data.forEach(function (element){
            sheet.insertRow({
                studentName: (data.nombres) ? data.nombres : "", 
                studentLastNames: (data.apellidos) ? data.apellidos : "",
                studentEmail: (data.correo) ? data.correo : "",
                studentPosition: (data.puesto) ? data.puesto : "",
                studentClass: (data.clase) ? data.clase : "",
                studentNote: (data.notaTotal) ? data.notaTotal : "",
            });
        });
    }
})


let excelData = {
    data: [
        {
            nombres: "",
            apellidos: "",
            correo: "",
            puesto: "",
            clase: "",
            notaTotal: "",
        }
    ],
    dataClassValidators: [
        {
            column: "A",
            data: [],
        }
    ],
}
    



