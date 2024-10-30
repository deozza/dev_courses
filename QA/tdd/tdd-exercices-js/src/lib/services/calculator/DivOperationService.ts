import AbstractOperationService from "./AbstractOperationService";

export default class DivOperationService extends AbstractOperationService
{
    public constructor(leftOperand, rightOperand)
    {
        super(leftOperand, rightOperand);
    }
    
    public getValue(): number
    {
        if(!Number.isFinite(this.leftOperand) || !Number.isFinite(this.rightOperand)){
            throw new Error("Operands must be numeric");
        }

        if(this.rightOperand === 0){
            throw Error("The right operand cannot be 0");
        }

        return this.leftOperand / this.rightOperand;
    }
}
