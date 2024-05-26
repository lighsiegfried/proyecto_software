$(document).ready(function (){

    var _workBook;

    window.generate_template = generate_template;
    window.import_template = importFile;

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
            {header: "Nombres", key: 'studentName', width: 30},
            {header: 'Apellidos', key: 'studentLastNames', width: 30},
            {header: 'Correo', key: 'studentEmail', width: 20},
            {header: 'Clase', key: 'studentClass', width: 30},
            {header: 'Nota Total (opcional)', key: 'studentNote', width: 30}
        ];

        sheet.getRow(1).eachCell((cell) => {
            cell.font = {
                name: 'Arial',
                family: 2,
                size: 12,
                bold: true,
                color: {argb: 'FFFFFF'} // Color de la fuente en blanco
            };
            cell.fill = {
                type: 'pattern',
                pattern: 'solid',
                fgColor: {argb: '1F4E78'} // Color de fondo azul oscuro
            };
            cell.alignment = {
                vertical: 'middle',
                horizontal: 'center'
            };
            cell.border = {
                top: {style: 'thin'},
                left: {style: 'thin'},
                bottom: {style: 'thin'},
                right: {style: 'thin'}
            };
        });

        if(data) insertStudentData(sheet, data);
    }
    
    function downloadTemplate(workbook) {
        workbook.xlsx.writeBuffer().then((buffer) => {
            const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'alumnos.xlsx';
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
                formulae: ['validators!$' + columnForValidationPage + '$1:$' + columnForValidationPage + '$' + dataLength]
            };
        }        
    }

    function insertStudentData(sheet, data){
        data.forEach(function (element){
            sheet.insertRow({
                studentName: (data.nombres) ? data.nombres : "", 
                studentLastNames: (data.apellidos) ? data.apellidos : "",
                studentEmail: (data.correo) ? data.correo : "",
                studentClass: (data.clase) ? data.clase : "",
                studentNote: (data.notaTotal) ? data.notaTotal : "",
            });
        });
    }

    //---------------------For import excel to JSON ------------------------------
    async function importFile(file){
        let studentsList = [];
        _workBook = new ExcelJS.Workbook;
        await _workBook.xlsx.load(file);

        const sheet = _workBook.getWorksheet(1);

        let studentObject = {
            nombres: "",
            apellidos: "",
            correo: "",
            puesto: '',
            clase: "",
        }
        
            sheet.eachRow({ includeEmpty: true }, function(row, rowNumber) {
                console.log()
                if(rowNumber > 1){
                    studentObject = {
                        nombres: row.getCell(1).value,
                        apellidos: row.getCell(2).value,
                        correo: row.getCell(3).value,
                        puesto: 6,
                        clase: convertColumnClassToIdClass(row.getCell(4).value),
                    }
                    studentsList.push(studentObject);
                }
                
            });
            
        return studentsList; 
    }


    function convertColumnClassToIdClass(column){
        // Encuentra la posición del último guion
        const lastDashIndex = column.lastIndexOf('-');

        // Extrae la subcadena después del último guion
        const result = column.substring(lastDashIndex + 1);

        return result;
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
    



