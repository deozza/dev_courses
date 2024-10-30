export default abstract class AbstractOperationService
{
    protected leftOperand;
    protected rightOperand;
    
    public constructor(leftOperand, rightOperand)
    {
        this.leftOperand = leftOperand;
        this.rightOperand = rightOperand;
    }

    abstract getValue(): number;
}