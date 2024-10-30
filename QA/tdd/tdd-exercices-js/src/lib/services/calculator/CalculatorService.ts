import type AbstractOperationService from "./AbstractOperationService";
import AddOperationService from "./AddOperationService";
import DivOperationService from "./DivOperationService";
import MultOperationService from "./MultOperationService";
import SubOperationService from "./SubOperationService";

export default class CalculatorService
{
    OPERATIONS: Array<string> = [
        '+',
        '-',
        '*',
        '/'
    ];

    public getErrorsFromRequestParams(requestParams: object): Array<string>
    {
        console.log(requestParams);

        let errors: Array<string> = [];

        if(requestParams.operation === undefined || requestParams.operation === null)
        {
            errors = [...errors, 'The operation is missing'];
        }
        
        if(requestParams.leftOperand === undefined || requestParams.leftOperand === null)
        {
            errors = [...errors, 'The left operand is missing'];
        }

        if(requestParams.rightOperand === undefined || requestParams.rightOperand === null)
        {
            errors = [...errors, 'The right operand is missing'];
        }

        return errors;
    }

    public checkOperationExists(operation: string): boolean
    {
        return this.OPERATIONS.includes(operation);
    }

    public checkOperatorsAreNumeric(leftOperand, rightOperand): boolean
    {
        return Number.isFinite(leftOperand) && Number.isFinite(rightOperand);
    }

    public calculate(operation: string, leftOperand, rightOperand): number
    {
        let operationService: AbstractOperationService|null = null;
        switch(operation){
            case '+':
                operationService = new AddOperationService(leftOperand, rightOperand);
                break;
            case '-':
                operationService = new SubOperationService(leftOperand, rightOperand);
                break;
            case '*':
                operationService = new MultOperationService(leftOperand, rightOperand);
                break;
            case '/':
                operationService = new DivOperationService(leftOperand, rightOperand);
                break;
        }
        if(operationService === null){
            throw new Error("The operation is not valid");
        }

        return operationService.getValue();
    }
}