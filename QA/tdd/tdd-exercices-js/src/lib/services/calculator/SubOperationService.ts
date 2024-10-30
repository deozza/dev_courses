import AbstractOperationService from "./AbstractOperationService";

export default class SubOperationService extends AbstractOperationService
{
    public constructor(leftOperand, rightOperand)
    {
        super(leftOperand, rightOperand);
    }
    
    public getValue(): number
    {
        if(Number.isFinite(this.leftOperand) && Number.isFinite(this.rightOperand)){
            return this.leftOperand - this.rightOperand;
        }
        throw Error("Operands must be numeric");
    }
}
