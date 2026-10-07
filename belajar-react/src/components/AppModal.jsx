//props
// import { Modal, Button } from "react-bootstrap";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
  DialogFooter,
} from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";

const AppModal = ({
  show,
  onClose,
  onSubmit,
  isLoading = false,
  showFooter = true,
  title,
  children,
  submitLabel = "Save",
  cancelLabel = "Cancel",
}) => {
  return (
    <Dialog open={show} openChange={onClose}>
      <DialogContent className="sm:max-w-[540px]">
        <DialogHeader>
          <DialogTitle>{title}</DialogTitle>
          <DialogDescription>
            This action cannot be undone. This will permanently delete your
            account and remove your data from our servers.
          </DialogDescription>
        </DialogHeader>
        <form onSubmit={onSubmit}>
          <div className="py-2"> {children}</div>
          <DialogFooter>
            <Button type="submit" disabled={isLoading}>
              {isLoading ? "Loading..." : submitLabel}{" "}
            </Button>
            <Button
              variant="outline"
              onClick={() => onClose(false)}
              type="submit"
              disable
            ></Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
};

export default AppModal;
